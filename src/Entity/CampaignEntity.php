<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource(
 *     shortName="campaign",
 *     description="Archaeological campaign",
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 */
class CampaignEntity implements SiteRelateEntityInterface
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
     * @var int
     */
    private $year;

    /**
     * @var BucketEntity
     * @ApiSubresource(maxDepth=1)
     */
    private $buckets;

    public function __construct()
    {
        $this->buckets = new ArrayCollection();
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

    public function addBucket(BucketEntity $bucket)
    {
        $this->buckets[] = $bucket;
        $bucket->setCampaign($this);
    }

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
        $campaignYear = $this->getYear() ? $this->getYear() : '0000';
        $campaignYear = substr($campaignYear, -2);

        return "$siteCode.$campaignYear";
    }
}
