<?php

namespace App\Services\Asaas;

use App\Models\Clients;
use App\Services\Api\ClientsServices;


class ClientsBusiness
{
    private $clientsServices;

    public function __construct(ClientsServices $clientsServices)
    {
        $this->clientsServices = $clientsServices;
        
    }
    public function criarCliente(Clients $client)
    {
        $response =$this->clientsServices->criarCliente($client);
        return $response;
    }
}