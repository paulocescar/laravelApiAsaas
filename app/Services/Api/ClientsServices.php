<?php

namespace App\Services\Api;

use App\Models\Clients;
use App\Repositories\Api\ClientsRepository;
use App\Repositories\Asaas\AsaasClientsRepository;
use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class ClientsServices
{
    private $clientsRepository;
    public function __construct(
        ClientsRepository $clientsRepository
    ){
        $this->clientsRepository = $clientsRepository;
    }
    public function criarCliente(array $client, array $dados)
    {
        DB::beginTransaction();
        try{
            $cliente = $this->client_adapter($client, $dados);
            $clientPogBanking = $this->clientsRepository->criarCliente($cliente);

            if(!$clientPogBanking){
                throw new HttpException(Response::HTTP_BAD_REQUEST, 'Não foi possivel criar um cliente pogbanking, contate o suporte. Erro:');
            }

            DB::commit();
            return $clientPogBanking;
        } catch (Exception $e) {
            DB::rollBack();
            throw new HttpException(Response::HTTP_BAD_REQUEST, 'O Servidor encontrou algum problema para criar uma conta, contate o suporte. Erro:'.$e->getMessage());
        }
    }
    public function atualizarCliente(array $dados, string $id)
    {
        DB::beginTransaction();
        try{
            $clientPogBanking = $this->clientsRepository->atualizarCliente($cliente, $id);

            if(!$clientPogBanking){
                throw new HttpException(Response::HTTP_BAD_REQUEST, 'Não foi possivel criar um cliente pogbanking, contate o suporte. Erro:');
            }

            DB::commit();
            return $clientPogBanking;
        } catch (Exception $e) {
            DB::rollBack();
            throw new HttpException(Response::HTTP_BAD_REQUEST, 'O Servidor encontrou algum problema para criar uma conta, contate o suporte. Erro:'.$e->getMessage());
        }
    }

    public function atualizarClienteAsaas(array $dados, string $clientAsaasId)
    {
        DB::beginTransaction();
        try{
            $cliente = $this->client_adapter([], $dados, $clientAsaasId);
            $clientPogBanking = $this->clientsRepository->atualizarClientePorIdClienteAsaas($cliente, $clientAsaasId);

            if(!$clientPogBanking){
                throw new HttpException(Response::HTTP_BAD_REQUEST, 'Não foi possivel criar um cliente pogbanking, contate o suporte. Erro:');
            }

            DB::commit();
            return $clientPogBanking;
        } catch (Exception $e) {
            DB::rollBack();
            throw new HttpException(Response::HTTP_BAD_REQUEST, 'O Servidor encontrou algum problema para criar uma conta, contate o suporte. Erro:'.$e->getMessage());
        }
    }

    public function client_adapter(array $client = [], array $dados, $id = null)
    {
        if(!$id){
            $cliente = [
                "client_asaas_id" => $client['id'],
                "name" => $client['name'],
                "cpfCnpj" => $client['cpfCnpj'],
                "password" => bcrypt($dados['password'])
            ];
        }  

        if($id){
            $cliente = [
                "name" => $dados['name'],
                "cpfCnpj" => $dados['cpfCnpj'],
                "password" => bcrypt($dados['password'])
            ];
        }

        return $cliente;
    }
}