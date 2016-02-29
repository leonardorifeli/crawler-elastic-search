<?php

namespace App\Bundle\Crawler\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

class GithubSyncController
{

    private $githubSyncService;

    private function getGithubSyncService($app)
    {
        if(!$this->githubSyncService) {
            $this->githubSyncService = $app['github.sync.service'];
        }

        return $this->githubSyncService;
    }

    public function startSync(Application $app, $token)
    {
        if($token !== $app['config']['security']['token']){
            return new Response(json_encode(['error' => 'invalid token']));
        }

        var_dump($app['config']['security']['token']);

        die;
    }

}
