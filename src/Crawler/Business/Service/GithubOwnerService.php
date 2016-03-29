<?php

namespace App\Bundle\Crawler\Business\Service;

use App\Bundle\Crawler\Entity\GithubOwner;

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
        return $repository;
    }

    public function getByProvider($provider)
    {
        $entities = $this->getRepository()->findOneBy([
            'providerCode' => $provider
        ]);

        return $entities;
    }

    public function createByRequest($request)
    {
        $entity = new GithubOwner();
        $entity->setLogin($request->login);
        $entity->setProviderCode($request->id);
        $entity->setUrl($request->url);
        $entity->setHomeUrl($request->homeUrl);
        $entity->setType($request->type);

        $entity = $this->insertOrUpdate($entity);

        return $entity;
    }

    private function insertOrUpdate($entity)
    {
        if (!$entity->getId()) {
            $entity = $this->em->persist($entity);
            $entity = $this->em->flush();
        } else {
            $entity = $this->em->flush();
        }

        return $entity;
    }

    public function getAll()
    {
        $entities = $this->getRepository()->findAll();
        return $entities;
    }

}
