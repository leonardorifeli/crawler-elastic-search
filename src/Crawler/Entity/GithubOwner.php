<?php

namespace App\Bundle\Crawler\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
* @Table(name="github_owner")
* @Entity()
**/
class GithubOwner
{

    /** @Id @Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=true) @GeneratedValue **/
    private $id;

    /** @Column(name="provider_code", type="integer", precision=0, scale=0, nullable=false, unique=true) **/
    private $providerCode;

    /** @Column(name="login", type="string", length=255, nullable=true) **/
    private $login;

    /** @Column(name="url", type="string", length=255, nullable=true) **/
    private $url;

    /** @Column(name="home_url", type="string", length=255, nullable=true) **/
    private $homeUrl;

    /** @Column(name="type", type="string", length=255, nullable=true) **/
    private $type;

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
     * Get the value of Login
     *
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of Login
     *
     * @param mixed login
     *
     * @return self
     */
    public function setLogin($login)
    {
        $this->login = $login;

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
     * Get the value of Home Url
     *
     * @return mixed
     */
    public function getHomeUrl()
    {
        return $this->homeUrl;
    }

    /**
     * Set the value of Home Url
     *
     * @param mixed homeUrl
     *
     * @return self
     */
    public function setHomeUrl($homeUrl)
    {
        $this->homeUrl = $homeUrl;

        return $this;
    }

    /**
     * Get the value of Type
     *
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of Type
     *
     * @param mixed type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

}
