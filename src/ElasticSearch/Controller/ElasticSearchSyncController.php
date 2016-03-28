<?php

namespace App\Bundle\ElasticSearch\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

class ElasticSearchSyncController
{

    private $elasticSearchSyncService;

    private function getElasticSearchSyncService($app) {
        if(!$this->elasticSearchSyncService) {
            $this->elasticSearchSyncService = $app['elasticSearch.sync.service'];
        }

        return $this->elasticSearchSyncService;
    }

    public function startSync(Application $app, $token) {
        set_time_limit(0);

        if($token !== $app['config']['security']['token']){
            return new Response(json_encode(['error' => 'invalid token']));
        }

        $syncOwner = $this->getElasticSearchSyncService($app)->createIndex('github');

        return;
    }

}
