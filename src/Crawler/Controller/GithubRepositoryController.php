<?php

namespace App\Bundle\Crawler\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

class GithubRepositoryController
{

    private $githubRepositoryService;

    private function getGithubRepositoryService($app)
    {
        if(!$this->githubRepositoryService) {
            $this->githubRepositoryService = $app['github.repository.service'];
        }

        return $this->githubRepositoryService;
    }

    public function indexAction(Application $app)
    {
        $entities = $this->getGithubRepositoryService($app)->getAll();
        return new Response(json_encode($entities));
    }

}
