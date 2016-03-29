<?php

namespace App\Bundle\ElasticSearch\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

class ElasticSearchSyncController
{

    private $elasticSearchSyncService;

    private function getElasticSearchSyncService($app)
    {
        if (!$this->elasticSearchSyncService) {
            $this->elasticSearchSyncService = $app['elasticSearch.sync.service'];
        }

        return $this->elasticSearchSyncService;
    }

    public function startSync(Application $app, $token)
    {
        set_time_limit(0);

        if ($token !== $app['config']['security']['token']) {
            return new Response(json_encode(['error' => 'invalid token']));
        }

        $this->getElasticSearchSyncService($app)->createIndex('github/owner');
        $this->getElasticSearchSyncService($app)->createIndex('github/repository');

        echo "Syncing...";

        $syncOwner = $this->getElasticSearchSyncService($app)->syncAllOwner();

        echo "Finished! Bye.";

        return new Response('Sincronizado');
    }

}
