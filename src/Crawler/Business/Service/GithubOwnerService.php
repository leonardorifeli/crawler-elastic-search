<?php

namespace App\Bundle\Crawler\Business\Service;

class GithubOwnerService
{

    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getRepository()
    {
        $repository = $this->em->getRepository('App\Bundle\Crawler\Entity\GithubOwner');
    }

}
