<?php

namespace App\Bundle\Crawler\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
* @Table(name="github_repository")
* @Entity()
**/
class GithubRepository
{

    /** @Id @Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=true) @GeneratedValue **/
    private $id;

    /** @Column(name="provider_code", type="integer", precision=0, scale=0, nullable=false, unique=true) **/
    private $providerCode;

    /**
    * @ManyToOne(targetEntity="App\Bundle\Crawler\Entity\GithubOwner")
    * @JoinColumn(name="owner_id", referencedColumnName="id")
    **/
    private $owner;

    /** @Column(name="name", type="string", length=255, nullable=true) **/
    private $name;

    /** @Column(name="url", type="string", length=255, nullable=true) **/
    private $url;

    /** @Column(name="language", type="string", length=255, nullable=true) **/
    private $language;

    /** @Column(name="description", type="text", precision=0, scale=0, nullable=true, unique=false) **/
    private $description;

    /** @Column(name="created_at", type="datetime", precision=0, scale=0, nullable=false, unique=false) **/
    private $createdAt;

    /** @Column(name="updated_at", type="datetime", precision=0, scale=0, nullable=false, unique=false) **/
    private $updatedAt;

    /** @Column(name="is_fork", type="boolean", nullable=false, unique=false) **/
    private $isFork;

    /** @Column(name="is_private", type="boolean", nullable=false, unique=false) **/
    private $isPrivate;

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Provider Code
     *
     * @return mixed
     */
    public function getProviderCode()
    {
        return $this->providerCode;
    }

    /**
     * Set the value of Provider Code
     *
     * @param mixed providerCode
     *
     * @return self
     */
    public function setProviderCode($providerCode)
    {
        $this->providerCode = $providerCode;

        return $this;
    }

    /**
     * Get the value of Owner
     *
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set the value of Owner
     *
     * @param mixed owner
     *
     * @return self
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get the value of Name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Name
     *
     * @param mixed name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of Url
     *
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of Url
     *
     * @param mixed url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get the value of Language
     *
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set the value of Language
     *
     * @param mixed language
     *
     * @return self
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get the value of Description
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of Description
     *
     * @param mixed description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of Created At
     *
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of Created At
     *
     * @param mixed createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of Updated At
     *
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of Updated At
     *
     * @param mixed updatedAt
     *
     * @return self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get the value of Is Fork
     *
     * @return mixed
     */
    public function getIsFork()
    {
        return $this->isFork;
    }

    /**
     * Set the value of Is Fork
     *
     * @param mixed isFork
     *
     * @return self
     */
    public function setIsFork($isFork)
    {
        $this->isFork = $isFork;

        return $this;
    }

    /**
     * Get the value of Is Private
     *
     * @return mixed
     */
    public function getIsPrivate()
    {
        return $this->isPrivate;
    }

    /**
     * Set the value of Is Private
     *
     * @param mixed isPrivate
     *
     * @return self
     */
    public function setIsPrivate($isPrivate)
    {
        $this->isPrivate = $isPrivate;

        return $this;
    }

}
