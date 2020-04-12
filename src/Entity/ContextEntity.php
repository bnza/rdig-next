<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 *  @ApiResource(
 *     shortName="context",
 *     description="Archaeological site contexts (stratographc units)",
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 */
class ContextEntity implements SiteRelateEntityInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $type = 'F';

    /**
     * @var int
     */
    private $cType;

    /**
     * @var int
     */
    private $num = 0;

    /**
     * @var SiteEntity
     */
    private $site;

    /**
     * @var AreaEntity
     */
    private $area;

    /**
     * @var PhaseEntity
     */
    private $phase;

    /**
     * @var VocFChronologyEntity
     */
    private $chronology;

    /**
     * @var BucketEntity
     * @ApiSubresource
     */
    private $buckets;

    /**
     * @var string
     */
    private $description;

    public function __construct()
    {
        $this->buckets = new ArrayCollection();
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getCType(): ?int
    {
        return $this->cType;
    }

    /**
     * @param int $cType
     */
    public function setCType($cType): void
    {
        if (!$cType) {
            $cType = null;
        } else {
            $cType = (int) $cType;
        }
        $this->cType = $cType;
    }

    /**
     * @return mixed
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * @param mixed $num
     */
    public function setNum($num): void
    {
        $this->num = $num;
    }

    /**
     * @return VocFChronologyEntity
     */
    public function getChronology(): ?VocFChronologyEntity
    {
        return $this->chronology;
    }

    /**
     * @param VocFChronologyEntity $chronology
     */
    public function setChronology($chronology): void
    {
        $this->chronology = $chronology;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return AreaEntity
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @return ArrayCollection
     */
    public function getBuckets()
    {
        return $this->buckets;
    }

    public function addBuckets(BucketEntity $bucket)
    {
        $this->buckets[] = $bucket;
        $bucket->setContext($this);
    }

    /**
     * @throws \Exception
     */
    public function setArea(AreaEntity $area): void
    {
        if (is_null($this->site)) {
            $this->setSite($area->getSite());
        }

        if ($area->getSite()->getId() !== $this->site->getId()) {
            $areaName = $area->getName();
            $siteName = $this->site->getName();
            // TODO find right exception
            throw new \Exception("AreaEntity \"$areaName\" does not belong to site \"$siteName\"");
        }

        $this->area = $area;
    }


//    /**
//     * @return PhaseEntity
//     */
//    public function getPhase(): PhaseEntity
//    {
//        return $this->phase;
//    }
//
//    /**
//     * @param PhaseEntity $phase
//     * @throws \Exception
//     */
//    public function setPhase(?PhaseEntity $phase): void
//    {
//        if (!is_null($phase)) {
//            if (is_null($this->site)) {
//                $this->setSite($phase->getSite());
//            }
//
//            if ($phase->getSite()->getId() !== $this->site->getId()) {
//                $phaseName = $phase->getName();
//                $siteName = $this->site->getName();
//                // TODO find right exception
//                throw new \Exception("PhaseEntity \"$phaseName\" does not belong to site \"$siteName\"");
//            }
//        }
//        $this->phase = $phase;
//    }

    /**
     * @return SiteEntity
     */
    public function getSite()
    {
        return $this->site;
    }

    public function setSite(SiteEntity $site): void
    {
        $this->site = $site;
    }

    public function getSiteId(): int
    {
        return $this->site->getId();
    }

    public function generateContextNum(LifecycleEventArgs $event)
    {
        $context = $event->getEntity();
        if (!$context->getNum()) {
            $repo = $event->getEntityManager()->getRepository(self::class);
            $num = $repo->getMaxSiteContextNum($context->getSite()->getId()) + 1;
            $context->setNum($num);
        }
    }
}
