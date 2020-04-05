<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity()
 * @ORM\Table(uniqueConstraints={
 *      @ORM\UniqueConstraint(columns={"num", "site"})
 * })
 * @UniqueEntity(
 *      fields={"num", "site"},
 *      message="Duplicate context number for this site"
 * )
 * @ORM\HasLifecycleCallbacks
 */
class Context implements SiteRelateEntityInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\Length(
     *     min = 1,
     *     max = 1
     * )
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=1, nullable=false, options={"fixed" = true})
     */
    private $type = "F";

    /**
     * @var int
     * @Assert\Type("integer")
     * @ORM\Column(type="smallint", nullable=true, options={"unsigned" = true})
     */
    private $cType;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="integer", nullable=false, options={"unsigned" = true})
     */
    private $num = 0;

    /**
     * @var Site
     * Many Context have One Site.
     * @ORM\ManyToOne(targetEntity="Site", inversedBy="contexts")
     * @ORM\JoinColumn(name="site", referencedColumnName="id", nullable=false, onDelete="NO ACTION")
     */
    private $site;

    /**
     * @var Area
     * Many Context have One Site.
     * @ORM\ManyToOne(targetEntity="Area", inversedBy="contexts")
     * @ORM\JoinColumn(name="area", referencedColumnName="id", nullable=false, onDelete="NO ACTION")
     */
    private $area;

    /**
     * @var Phase
     * Many Context have One Site.
     * @ORM\ManyToOne(targetEntity="Phase", inversedBy="contexts")
     * @ORM\JoinColumn(name="phase", referencedColumnName="id", nullable=true, onDelete="NO ACTION")
     */
    private $phase;

    /**
     * @var VocFChronology
     * @ORM\ManyToOne(targetEntity="VocFChronology")
     * @ORM\JoinColumn(name="chronology", referencedColumnName="id", nullable=true, onDelete="NO ACTION")
     */
    private $chronology;

    /**
     * One Site has Many Areas.
     * @ORM\OneToMany(targetEntity="Bucket", mappedBy="context")
     */
    private $buckets;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function __construct()
    {
        $this->buckets = new ArrayCollection();
    }

    /**
     * @return int
     */
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
            $cType = (int)$cType;
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
     * @return VocFChronology
     */
    public function getChronology(): ?VocFChronology
    {
        return $this->chronology;
    }

    /**
     * @param VocFChronology $chronology
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
     * @return Area
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

    /**
     * @param Bucket $bucket
     */
    public function addBuckets(Bucket $bucket)
    {
        $this->buckets[] = $bucket;
        $bucket->setContext($this);
    }

    /**
     * @param Area $area
     * @throws \Exception
     */
    public function setArea(Area $area): void
    {
        if (is_null($this->site)) {
            $this->setSite($area->getSite());
        }

        if ($area->getSite()->getId() !== $this->site->getId()) {
            $areaName = $area->getName();
            $siteName = $this->site->getName();
            // TODO find right exception
            throw new \Exception("Area \"$areaName\" does not belong to site \"$siteName\"");
        }

        $this->area = $area;
    }

//    /**
//     * @return Phase
//     */
//    public function getPhase(): Phase
//    {
//        return $this->phase;
//    }
//
//    /**
//     * @param Phase $phase
//     * @throws \Exception
//     */
//    public function setPhase(?Phase $phase): void
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
//                throw new \Exception("Phase \"$phaseName\" does not belong to site \"$siteName\"");
//            }
//        }
//        $this->phase = $phase;
//    }

    /**
     * @return Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param Site $site
     */
    public function setSite(Site $site): void
    {
        $this->site = $site;
    }

    public function getSiteId(): int
    {
        return $this->site->getId();
    }

    /**
     * @ORM\PrePersist
     */
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
