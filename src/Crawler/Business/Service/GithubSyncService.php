<?php

namespace App\Bundle\Crawler\Business\Service;

class GithubSyncService
{

    private $githubRepositoryService;

    public function __construct($githubRepositoryService)
    {
        $this->githubRepositoryService = $githubRepositoryService;
    }

}
