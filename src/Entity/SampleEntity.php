<?php

namespace App\Entity;

use Doctrine\ORM\Event\LifecycleEventArgs;

class SampleEntity extends FindingEntity
{
    /**
     * @var CampaignEntity
     */
    private $campaign;

    /**
     * @var int
     */
    private $no;

    /**
     * @var string
     */
    private $status;

    /**
     * @var VocSTypeEntity
     */
    private $type;

    public function getCampaign(): CampaignEntity
    {
        return $this->campaign;
    }

    public function setCampaign(CampaignEntity $campaign): void
    {
        $this->campaign = $campaign;
    }

    public function getNo(): int
    {
        return $this->no;
    }

    public function setNo(int $no): void
    {
        $this->no = $no;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function getType(): VocSTypeEntity
    {
        return $this->type;
    }

    public function setType(VocSTypeEntity $type): void
    {
        $this->type = $type;
    }

    public function setCampaignByBucket(LifecycleEventArgs $event)
    {
        if (!isset($this->campaign)) {
            $finding = $event->getEntity();
            $this->campaign = $finding->getBucket()->getCampaign();
        }
    }
}
