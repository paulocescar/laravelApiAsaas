<?php

namespace App\Business\Asaas;

use App\Models\ClientsAsaas;
use App\Services\Asaas\AsaasClientsServices;


class AsaasClientsBusiness
{
    private $asaasClientsServices;

    public function __construct(AsaasClientsServices $asaasClientsServices)
    {
        $this->asaasClientsServices = $asaasClientsServices;
        
    }
    public function criarCliente(array $dados)
    {
        $cliente = new ClientsAsaas($dados);
        $response = $this->asaasClientsServices->criarCliente($cliente);

        return $response;
    }

    public function atualizarCliente(array $dados, int $id)
    {
        $cliente = new ClientsAsaas($dados);
        $response = $this->asaasClientsServices->atualizarCliente($cliente, $id);

        return $response;
    }
}