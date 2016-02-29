<?php

namespace App\Bundle\Crawler\Business\Service;

use App\Bundle\Crawler\Entity\GithubRepository;

class GithubRepositoryService
{

    private $em;
    private $githubOwnerService;

    public function __construct($em, $githubOwnerService)
    {
        $this->em = $em;
        $this->githubOwnerService = $githubOwnerService;
    }

    public function getRepository()
    {
        $repository = $this->em->getRepository('App\Bundle\Crawler\Entity\GithubRepository');
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

        $owner = $this->githubOwnerService->getByProvider($request->owner->id);

        if(!$owner){
            $owner = $this->githubOwnerService->createByRequest($request->owner);
        }

        if(!$owner) return;

        $entity = new GithubRepository();
        $entity->setOwner($owner);
        $entity->setProviderCode($request->id);
        $entity->setName($request->full_name);
        $entity->setUrl($request->url);
        $entity->setLanguage("");
        $entity->setDescription($request->description);
        $entity->setCreatedAt(new \DateTime());
        $entity->setUpdatedAt(new \DateTime());
        $entity->setIsFork($request->fork);
        $entity->setIsPrivate($request->private);

        $entity = $this->insertOrUpdate($entity);

        return $entity;
    }

    private function insertOrUpdate($entity)
    {
        if(!$entity->getId()) {
            $entity = $this->em->persist($entity);
            $entity = $this->em->flush();
        }else{
            $entity = $this->em->flush();
        }

        return $entity;
    }

}
