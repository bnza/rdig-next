<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * @ApiResource(
 *     shortName="bucket",
 *     description="Context's finding close group",
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 */
class BucketEntity implements SiteRelateEntityInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var CampaignEntity
     */
    private $campaign;

    /**
     * @var string
     */
    private $num;

    /**
     * @var ContextEntity
     */
    private $context;

    /**
     * @var FindingEntity
     * @ApiSubresource
     */
    private $findings;

    public function __construct()
    {
        $this->findings = new ArrayCollection();
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
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    public function getCampaign(): CampaignEntity
    {
        return $this->campaign;
    }

    public function setCampaign(CampaignEntity $campaign): void
    {
        $this->campaign = $campaign;
    }

    /**
     * @return string
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * @param string $num
     */
    public function setNum($num): void
    {
        $this->num = $num;
    }

    public function getContext(): ContextEntity
    {
        return $this->context;
    }

    public function setContext(ContextEntity $context): void
    {
        $this->context = $context;
    }

    /**
     * @return mixed
     */
    public function getFindings()
    {
        return $this->findings;
    }

    /**
     * @param mixed $findings
     */
    public function setFindings(FindingEntity $findings): void
    {
        $this->findings = $findings;
    }

    public function getSiteId(): int
    {
        return $this->campaign->getSiteId();
    }

    public function toArray(bool $ancestors = true, bool $descendants = false)
    {
        $data = [
            'id' => $this->id,
            'type' => $this->type,
            'num' => $this->num,
        ];

        if ($ancestors) {
            $data['campaign'] = $this->campaign->toArray();
            $data['context'] = $this->context->toArray();
        }

        return $data;
    }

    /**
     * @param LifecycleEventArgs $event
     */
    public function generateBucketNum(LifecycleEventArgs $event)
    {
        $context = $event->getEntity();
        if (!$context->getNum()) {
            $repo = $event->getEntityManager()->getRepository(self::class);
            $num = $repo->getMaxCampaignBucketNum($context->getCampaign()->getId()) + 1;
            $context->setNum($num);
        }
    }

    /**
     * @param LifecycleEventArgs $event
     */
    public function formatNum(LifecycleEventArgs $event)
    {
        $bucket = $event->getEntity();
        $num = $bucket->getNum();
        if (strlen((string) $num) > 4) {
            throw new \InvalidArgumentException("BucketEntity num must be max 4 char length $num given");
        }
        $num = sprintf("%'.04s", $num);
        $bucket->setNum($num);
    }

    public function __toString()
    {
        $campaign = $this->getCampaign() ? (string) $this->getCampaign() : 'XX.00';
        if (in_array(substr($campaign, 0, 2), ['TH', 'TG'])) {
            $area = $this->getContext() ? $this->getContext()->getArea() : null;
            $bucketCode = $area ? $area->getCode() : 'XX';
        } else {
            $bucketCode = $this->getType() ? $this->getType() : 'X';
        }
        $bucketNum = $this->getNum() ? $this->getNum() : '0000';

        return "$campaign.$bucketCode.$bucketNum";
    }
}
