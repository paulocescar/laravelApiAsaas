<?php

namespace App\Repositories\Asaas;

use Illuminate\Support\Facades\Http;

class AsaasApi{

    private $asaasApiUrl;
    private $acessToken;
    public function __construct()
    {
        $this->asaasApiUrl = env('ASAAS_API_MODE_SANDBOX') ? env('ASAAS_SANDBOX_URL') : env('ASAAS_PROD_URL');
        $this->acessToken = env('ASAAS_API_MODE_SANDBOX') ? env('ASAAS_API_SANDBOX_TOKEN') : env('ASAAS_PROD_URL');

    }

    public function asaasApiPost(string $url,array $object)
    {

        $thisurl = $this->asaasApiUrl.''.$url;

        return  Http::withHeaders([
                    'access_token' => $this->acessToken
                ])->post($thisurl, $object);
    }

    public function asaasApiGet(string $url)
    {
        $thisurl = $this->asaasApiUrl.''.$url;

        return  Http::withHeaders([
                    'access_token' => $this->acessToken
                ])->post($thisurl);
    }

    public function asaasApiDelete(string $url, string $id)
    {
        $thisurl = $this->asaasApiUrl.''.$url.''.$id;

        return  Http::withHeaders([
                    'access_token' => $this->acessToken
                ])->delete($thisurl);
    }
}