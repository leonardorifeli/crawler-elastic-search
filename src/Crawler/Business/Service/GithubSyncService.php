<?php

namespace App\Bundle\Crawler\Business\Service;

use GuzzleHttp\Client;

class GithubSyncService
{

    private $githubRepositoryService;
    private $httpClient;

    public function __construct($githubRepositoryService)
    {
        $this->githubRepositoryService = $githubRepositoryService;
        $this->httpClient = new Client();
    }

    public function startSync()
    {
        $since = 1;
        $response = true;

        while($register !== false) {
            $response = $this->getReponse($since);
            $response = json_decode($response->getBody());

            if(!$response) {
                $response = false;
                return;
            }

            foreach($response as $key => $request) {
                $entity = $this->createOrUpdateRepository($request);

                if($entity){
                    echo "#{$entity->getProviderCode()} - Created Repository: {$entity->getName()} <br/>";
                }
            }

            if($since == 10) {
                $response = false;
            }

            $since++;
        }

        die;
    }

    private function createOrUpdateRepository($request)
    {
        if(!$request){
            return;
        }

        $entity = $this->githubRepositoryService->getByProvider($request->id);

        if(!$entity) {
            $entity = $this->githubRepositoryService->createByRequest($request);
        }

        return $entity;
    }

    private function getReponse($since)
    {
        $clientId = "828dc2ffacfca66489ec";
        $clientSecret = "695eb7620fc8ef31ca148c252fca5b8b6fcfc689";

        return $this->httpClient->request('GET', "https://api.github.com/repositories?client_id={$clientId}&client_secret={$clientSecret}&since={$since}", []);
    }

}
