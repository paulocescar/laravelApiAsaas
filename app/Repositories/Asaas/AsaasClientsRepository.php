<?php

namespace App\Repositories\Asaas;

use App\Models\ClientsAsaas;
use App\Repositories\Asaas\AsaasApi;

class AsaasClientsRepository
{
    private $asaasApi;
    public function __construct(AsaasApi $asaasApi)
    {
        $this->asaasApi = $asaasApi;
    }

    public function criarClienteAsaas(ClientsAsaas $client)
    {
        $url = '/api/v3/customers/';
        $response = $this->asaasApi->asaasApiPost($url, $client->toArray());
        
        return $response;
    }

    public function criarCliente(array $cliente)
    {
        return ClientsAsaas::create($cliente);
    }

    public function atualizarCliente(array $client, $id = null)
    {
        return ClientsAsaas::where('id',$id)->update($client);
    }

    public function recuperarClientePorId(string $idClient)
    {
        $url = '/api/v3/customers/'.$idClient;
        $response = $this->asaasApi->asaasApiGet($url);
        
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
        $url = '/api/v3/customers/';

        $url .= $this->adapterFiltros($name, $email, $cpfCnpj, $groupName, $externalReference, $offset, $limit);
        $response = $this->asaasApi->asaasApiGet($url);

        return $response;
    }

    public function atualizarClienteAsaas(ClientsAsaas $client)
    {
        $url = '/api/v3/customers/'.$client->asaas_customer_id;
        $response = $this->asaasApi->asaasApiPost($url, $client->toArray());

        return $response;
    }

    public function removerClienteAsaas(string $idClient)
    {
        $url = '/api/v3/customers/'.$idClient;
        $response = $this->asaasApi->asaasApiDelete($url, $idClient);

        return $response;
    }


    public function removerCliente($id)
    {
        return ClientsAsaas::find($id)->update(['lixeira' => 'sim']);
    }


    public function restaurarCliente(string $idClient)
    {
        $url = '/api/v3/customers/'.$idClient.'/restore';
        $response = $this->asaasApi->asaasApiGet($url);

        return $response;
    }
    public function recuperarNotificacoesCliente(string $idClient)
    {
        $url = '/api/v3/customers/'.$idClient.'/notifications';
        $response = $this->asaasApi->asaasApiGet($url);

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