<?php

namespace App\Repositories\Asaas;

use App\Models\Clients;
use Illuminate\Support\Facades\Http;

class AsaasClientsRepository
{
    private $asaasApiUrl;

    public function __construct()
    {
        $this->asaasApiUrl = env('ASAAS_API_MODE_SANDBOX') ? env('ASAAS_SANDBOX_URL') : env('ASAAS_PROD_URL');
        
    }
    public function criarCliente(Clients $client)
    {
        $url = $this->asaasApiUrl.'/api/v3/customers';
        $response = Http::post($url, $client);

        return $response;
    }

    public function recuperarClientePorId(string $idClient)
    {
        $url = $this->asaasApiUrl.'/api/v3/customers'.$idClient;
        $response = Http::get($url);

        return $response;
    }


    public function recuperarClientes(string $name = "", 
                                    string $email = "", 
                                    string $cpfCnpj = "",
                                    string $groupName = "",  
                                    string $externalReference = "",  
                                    string $offset = "",
                                    string $limit = "")
    {
        $url = $this->asaasApiUrl.'/api/v3/customers/';
        $url .= $this->adapterFiltros($name, $email, $cpfCnpj, $groupName, $externalReference, $offset, $limit);
        
        $response = Http::get($url);

        return $response;
    }

    public function atualizarCliente(string $idClient, Clients $client)
    {
        $url = $this->asaasApiUrl.'/api/v3/customers/'.$idClient;
        $response = Http::post($url, $client);

        return $response;
    }


    public function removerCliente(string $idClient, Clients $client)
    {
        $url = $this->asaasApiUrl.'/api/v3/customers/'.$idClient;
        $response = Http::delete($url, $client);

        return $response;
    }

    public function restaurarCliente(string $idClient, Clients $client)
    {
        $url = $this->asaasApiUrl.'/api/v3/customers/'.$idClient.'/restore';
        $response = Http::get($url, $client);

        return $response;
    }
    public function recuperarNotificacoesCliente(string $idClient, Clients $client)
    {
        $url = $this->asaasApiUrl.'/api/v3/customers/'.$idClient.'/notifications';
        $response = Http::get($url, $client);

        return $response;
    }

    public function adapterFiltros(string $name = "", 
                                    string $email = "", 
                                    string $cpfCnpj = "",
                                    string $groupName = "",  
                                    string $externalReference = "",  
                                    string $offset = "",
                                    string $limit = ""): string
    {
        $url = '';

        if($name || $email || $cpfCnpj || $groupName || $externalReference || $offset || $limit){
            $url .= '?';
        }
        if($name){              $url .= '&name='.$name; }
        if($email){             $url .= '&email='.$email; }
        if($cpfCnpj){           $url .= '&cpfCnpj='.$cpfCnpj; }
        if($groupName){         $url .= '&groupName='.$groupName; }
        if($externalReference){ $url .= '&externalReference='.$externalReference; }
        if($offset){            $url .= '&offset='.$offset; }
        if($limit){             $url .= '&limit='.$limit; }

        return $url;
    }
}