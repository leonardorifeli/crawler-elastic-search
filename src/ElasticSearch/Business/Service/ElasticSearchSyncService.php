<?php

namespace App\Bundle\ElasticSearch\Business\Service;

use Symfony\Component\HttpFoundation\Response;
use Elasticsearch\Client();

class ElasticSearchSyncService
{

    private $httpClient;
    private $url;
    private $githubOwnerService;
    private $githubRepositoryService;

    public function __construct($url, $githubOwnerService, $githubRepositoryService)
    {
        $this->httpClient = new Client();
        $this->url = $url;
        $this->githubOwnerService = $githubOwnerService;
        $this->githubRepositoryService = $githubRepositoryService;
    }

    public function getHttpClient()
    {
        if (!$this->httpClient) $this->httpClient = new Client();
        return $this->httpClient;
    }

    public function createIndex($index)
    {
        $response = $this->checkOrCreateIndex($index);
        return $response;
    }

    public function syncAllOwner()
    {
        if (!$this->githubOwnerService) return;

        $entities = $this->githubOwnerService->getAll();
        if (!$entities) return;

        $data = [];
        foreach ($entities as $key => $owner) {
            $objectData = [
                'id' => $owner->getId(),
                'login' => $owner->getLogin(),
                'url' => $owner->getUrl(),
                'type' => $owner->getType()
            ];

            $data[] = '-i';
            $data[] = $objectData;

            $request = $this->sendRequest('github/owner/'.$owner->getId(), $data, 'POST');

            $repositories = $this->syncRepositoriesByOwner($owner);
        }

        return $data;
    }

    public function syncRepositoriesByOwner($owner)
    {
        if (!$this->githubRepositoryService) return;

        $entities = $this->githubRepositoryService->getAllByOwner($owner);
        if (!$entities) return;

        $data = [];
        foreach ($entities as $key => $repository) {
            $objectData = [
                'ownerId' => $repository->getOwner(),
                'name' => $repository->getName(),
                'url' => $repository->getUrl(),
                'description' => $repository->getDescription(),
                'isFork' => $repository->getIsFork(),
                'isPrivate' => $repository->getIsPrivate()
            ];

            $data[] = $objectData;

            $request = $this->sendRequest('github/repository', $objectData, 'POST');
        }

        return $data;
    }

    private function checkOrCreateIndex($index)
    {
        $url = "{$this->url}/{$index}";
        
        $request = $this->httpClient->request('GET', $url, ["-i"]);

        if ($request->getStatusCode() != Response::HTTP_OK) {
            $request = $this->httpClient->request('GET', $url, ["-d"]);
        }

        return $request;
    }

    private function sendRequest($index, $data, $type)
    {
        $url = "{$this->url}/{$index}";

        if(!array_key_exists(0, $data) || !array_key_exists(1, $data)) return [];

        $data = json_encode($data[1]);

        var_dump($url);
        var_dump($data);
        die;

        $request = $this->httpClient->request($type, $url, $data);
        dump($request);
        die;
        return $request;
    }

}
