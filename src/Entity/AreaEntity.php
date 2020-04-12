<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource(
 *     shortName="area",
 *     description="Archaeological site area",
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 */
class AreaEntity implements SiteRelateEntityInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $location;

    /**
     * @var SiteEntity
     */
    private $site;

    /**
     * @var ContextEntity
     * @ApiSubresource(maxDepth=1)
     */
    private $contexts;

    public function __construct()
    {
        $this->contexts = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return SiteEntity
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param SiteEntity $site
     */
    public function setSite($site): void
    {
        $this->site = $site;
    }

    public function getSiteId(): int
    {
        return $this->site->getId();
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location): void
    {
        $this->location = $location;
    }

    /**
     * @return ArrayCollection
     */
    public function getContexts()
    {
        return $this->contexts;
    }

    /**
     * @param ContextEntity $context
     * @throws \Exception
     */
    public function addContexts(ContextEntity $context)
    {
        $this->contexts[] = $context;
        $context->setArea($this);
    }
}
