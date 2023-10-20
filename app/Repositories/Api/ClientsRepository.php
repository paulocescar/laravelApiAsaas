<?php

namespace App\Repositories\Api;

use App\Models\Clients;

class ClientsRepository
{
    public function __construct()
    {
        
    }
    public function criarCliente(array $client)
    {
        return Clients::create($client);
    }

    public function atualizarCliente(array $client, int $id)
    {
        return Clients::where('id',$id)->update($client);
    }

    public function atualizarClientePorIdClienteAsaas(array $client, string $clientAsaasId)
    {
        return Clients::where('client_asaas_id',$clientAsaasId)->update($client);
    }
}