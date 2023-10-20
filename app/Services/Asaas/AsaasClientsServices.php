<?php

namespace App\Services\Asaas;

use App\Models\ClientsAsaas;
use App\Repositories\Asaas\AsaasClientsRepository;
use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class AsaasClientsServices
{
    private $asaasClientsRepository;

    public function __construct(AsaasClientsRepository $asaasClientsRepository)
    {
        $this->asaasClientsRepository = $asaasClientsRepository;
        
    }
    public function criarCliente(ClientsAsaas $client)
    {
        DB::beginTransaction();
        try{
            $clientAsaas = $this->asaasClientsRepository->criarClienteAsaas($client);

            if(!$clientAsaas->successful()){
                throw new HttpException(Response::HTTP_BAD_REQUEST, 'Não foi possivel criar um cliente pogbanking, contate o suporte. Erro:');
            }

            $dadosCliente = $this->cliente_asaas_banking_adapter($clientAsaas->json());
            $dadosCliente = new ClientsAsaas($dadosCliente);
            $clientBankingAsaas = $this->asaasClientsRepository->criarCliente($dadosCliente->toArray());

            if(!$clientBankingAsaas){
                throw new HttpException(Response::HTTP_BAD_REQUEST, 'Não foi possivel criar um cliente pogbanking, contate o suporte. Erro:');
            }
            
            DB::commit();
            return $clientBankingAsaas;
        } catch (Exception $e) {
            DB::rollBack();
            throw new HttpException(Response::HTTP_BAD_REQUEST, 'O Servidor encontrou algum problema para criar uma conta, contate o suporte. Erro:'.$e->getMessage());
        }
    }

    public function atualizarCliente(ClientsAsaas $client, int $id)
    {
        DB::beginTransaction();
        try{
            $clientAsaas = $this->asaasClientsRepository->atualizarClienteAsaas($client);

            if(!$clientAsaas->successful()){
                throw new HttpException(Response::HTTP_BAD_REQUEST, 'Não foi possivel criar um cliente pogbanking, contate o suporte. Erro:');
            }
            
            $clientBankingAsaas = $this->asaasClientsRepository->atualizarCliente($client->toArray(), $id);

            if(!$clientBankingAsaas){
                throw new HttpException(Response::HTTP_BAD_REQUEST, 'Não foi possivel criar um cliente pogbanking, contate o suporte. Erro:');
            }
            
            DB::commit();
            return $clientBankingAsaas;
        } catch (Exception $e) {
            DB::rollBack();
            throw new HttpException(Response::HTTP_BAD_REQUEST, 'O Servidor encontrou algum problema para criar uma conta, contate o suporte. Erro:'.$e->getMessage());
        }
    }
    public function cliente_asaas_banking_adapter(array $cliente)
    {
        $cliente = [
            ...$cliente,
            "asaas_customer_id" => $cliente['id']
        ];

        return $cliente;
    }
}