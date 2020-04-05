<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity()
 * @ORM\Table(uniqueConstraints={
 *      @ORM\UniqueConstraint(columns={"site", "year"})
 * })
 * @UniqueEntity(
 *      fields={"site", "year"},
 *      errorPath="year",
 *      message="Duplicate campaign year [{{ value }}] for this site"
 * )
 * @ORM\HasLifecycleCallbacks
 */
class Campaign implements SiteRelateEntityInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Site
     * Many Areas have One Site.
     * @ORM\ManyToOne(targetEntity="Site", inversedBy="campaigns")
     * @ORM\JoinColumn(name="site", referencedColumnName="id", nullable=false, onDelete="NO ACTION")
     */
    private $site;

    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min = 2000,
     *     max = 2099,
     *     minMessage = "Campaign's year lower limit is {{ limit }}",
     *     maxMessage = "Campaign's year upper limit is {{ limit }}"
     * )
     * @ORM\Column(
     *     type="smallint",
     *     nullable=false
     *     )
     */
    private $year;

    /**
     * One Site has Many Areas.
     * @ORM\OneToMany(targetEntity="Bucket", mappedBy="campaign")
     */
    private $buckets;

    public function __construct() {
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
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

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
    public function setSite($site): void
    {
        $this->site = $site;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
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
    public function addBucket(Bucket $bucket)
    {
        $this->buckets[] = $bucket;
        $bucket->setCampaign($this);
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    public function getSiteId(): int
    {
        return $this->site->getId();
    }

    public function toArray(bool $ancestors = true, bool $descendants = false)
    {
        $data = [
            'id' => $this->id,
            'year' => $this->year,
        ];

        if ($ancestors) {
            $data['site'] =  $this->site->toArray();
        }

        return $data;
    }

    public function __toString()
    {
        $siteCode = 'XX';
        if ($this->getSite()) {
            $siteCode = $this->getSite()->getCode() ? $this->getSite()->getCode() : $siteCode;
        }
        $campaignYear = $this->getYear() ? $this->getYear() : '0000';
        $campaignYear = substr($campaignYear, -2);
        return "$siteCode.$campaignYear";
    }

}
