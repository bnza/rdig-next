<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource(
 *     shortName="site",
 *     description="Archaeological site",
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 */
class SiteEntity implements SiteRelateEntityInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var UsersSitesJoinEntity[]
     */
    private $allowedUsers;

    /**
     * @var AreaEntity[]
     * @ApiSubresource(maxDepth=1)
     */
    private $areas;

    /**
     * @var CampaignEntity[]
     */
    private $campaigns;

    /**
     * @var string
     */
    private $code;

    /**
     * @var ContextEntity[]
     */
    private $contexts;

    /**
     * @var string
     */
    private $name;

    /**
     * @var PhaseEntity[]
     */
    private $phases;

    public function __construct()
    {
        $this->allowedUsers = new ArrayCollection();
        $this->areas = new ArrayCollection();
        $this->contexts = new ArrayCollection();
        $this->campaigns = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getAreas()
    {
        return $this->areas;
    }

    public function addArea(AreaEntity $area)
    {
        $this->areas[] = $area;
        $area->setSite($this);
    }

//    /**
//     * @return ArrayCollection
//     */
//    public function getContexts()
//    {
//        return $this->contexts;
//    }
//
//    /**
//     * @param ContextEntity $context
//     */
//    public function addContexts(ContextEntity $context)
//    {
//        $this->contexts[] = $context;
//        $context->setSite($this);
//    }
//    }
//
//    public function removeUser(UserEntity $user)
//    {
//        $this->users->removeElement($user);
//    }

    public function getId(): int
    {
        return $this->id;
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
        $this->code = strtoupper($code);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getSiteId(): int
    {
        return $this->getId();
    }
}
