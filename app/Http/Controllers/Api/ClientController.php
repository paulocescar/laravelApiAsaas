<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateClientRequest;
use App\Services\Api\ClientsServices;
use App\Business\Asaas\AsaasClientsBusiness;
use Carbon\Exceptions\Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    private $clientsBusiness;
    private $asaasClientsBusiness;
    public function __construct(
        ClientsServices $clientsBusiness,
        AsaasClientsBusiness $asaasClientsBusiness
    ){
        $this->clientsBusiness = $clientsBusiness;
        $this->asaasClientsBusiness = $asaasClientsBusiness;
    }

    public function criarClientes(CreateClientRequest $request)
    {
        try{
            $dados = $request->all();
            $asaasdados = $this->asaasClientsBusiness->criarCliente($dados);

            $clientBanking = $this->clientsBusiness->criarCliente($asaasdados->toArray(), $dados);

            return response()->json(["status" => 200, "data" => $clientBanking], 200);
        } catch (Exception) {
            throw new HttpException(Response::HTTP_BAD_REQUEST, "Erro desconhecido, contate o suporte");
        }
    }


    public function atualizarClientesAsaas(CreateClientRequest $request, $id)
    {
        try{
            $dados = $request->all();
            $this->asaasClientsBusiness->atualizarCliente($dados, $id);

            $clientBanking = $this->clientsBusiness->atualizarClienteAsaas($dados, $id);

            return response()->json(["status" => 200, "data" => $clientBanking], 200);
        } catch (Exception) {
            throw new HttpException(Response::HTTP_BAD_REQUEST, "Erro desconhecido, contate o suporte");
        }
    }
}
