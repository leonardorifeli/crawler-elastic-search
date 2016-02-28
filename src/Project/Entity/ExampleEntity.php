<?php

namespace Silex\Bundle\Project\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
* @Table(name="example")
* @Entity()
**/
class ExampleEntity
{

    /** @Id @Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=true) @GeneratedValue **/
    private $id;

    /**
    * @ManyToOne(targetEntity="App")
    * @JoinColumn(name="relation", referencedColumnName="id")
    **/
    private $relation;

    /** @Column(name="title", type="string", length=255, nullable=true) **/
    private $title;

    /** @Column(name="datetime_example", type="datetime", precision=0, scale=0, nullable=false, unique=false) **/
    private $dateTime;

    /** @Column(name="integer_example", type="integer", precision=0, scale=0, nullable=false, unique=false) **/
    private $integer;

}
