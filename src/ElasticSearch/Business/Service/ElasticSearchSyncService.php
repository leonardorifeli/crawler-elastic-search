<?php

namespace App\Bundle\ElasticSearch\Business\Service;

use GuzzleHttp\Client;

class ElasticSearchSyncService
{

    private $httpClient;
    private $url;

    public function __construct($url) {
        $this->httpClient = new Client();
        $this->url = $url;
    }

    public function getHttpClient() {
        if(!$this->httpClient) $this->httpClient = new Client();
        return $this->httpClient;
    }

    public function createIndex($index) {
        $this->checkIndex($index);
    }

    private function checkIndex($index) {

        var_dump($this->httpClient->request('GET', "{$this->url}/{$index}", []));
        die;
        
        //$this->httpClient->request('GET', , []);
    }

}
