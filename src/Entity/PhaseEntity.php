<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @UniqueEntity(
 *      fields={"site", "name"},
 *      errorPath="name",
 *      message="Duplicate phase name [{{ value }}] for this site"
 * )
 */
class PhaseEntity implements SiteRelateEntityInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var SiteEntity
     */
    private $site;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var ContextEntity
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
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return ArrayCollection
     */
    public function getContexts()
    {
        return $this->contexts;
    }

    /**
     * @throws \Exception
     */
    public function addContext(ContextEntity $context)
    {
        $this->contexts[] = $context;
        $context->setPhase($this);
    }

    public function getSiteId(): int
    {
        return $this->site->getId();
    }

    public function toArray(bool $ancestors = true, bool $descendants = false)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
        ];

        if ($ancestors) {
            $data['site'] = $this->site->toArray();
        }

        return $data;
    }

    public function __toString()
    {
        $siteCode = 'XX';
        if ($this->getSite()) {
            $siteCode = $this->getSite()->getCode() ? $this->getSite()->getCode() : $siteCode;
        }

        return "$siteCode.{$this->getName()}";
    }
}
