<?php
/**
 * Created by PhpStorm.
 * User: petrux
 * Date: 04/05/18
 * Time: 9.15
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Table(name="sample", uniqueConstraints={
 *      @ORM\UniqueConstraint(columns={"campaign", "no"})
 * })
 *
 * @UniqueEntity(
 *      fields={"campaign", "no"},
 *      errorPath="no",
 *      message="Duplicate registration number [{{ value }}] for this campaign "
 * )
 *
 * @ORM\HasLifecycleCallbacks()
 */
class Sample extends AbstractFinding
{
    /**
     * @var Campaign
     * @ORM\ManyToOne(targetEntity="Campaign")
     * @ORM\JoinColumn(name="campaign", referencedColumnName="id", nullable=false, onDelete="NO ACTION")
     */
    private $campaign;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    private $no;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $status;

    /**
     * @var VocSType
     * @ORM\ManyToOne(targetEntity="VocSType")
     * @ORM\JoinColumn(name="type", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $type;

    /**
     * @return Campaign
     */
    public function getCampaign(): Campaign
    {
        return $this->campaign;
    }

    /**
     * @param Campaign $campaign
     */
    public function setCampaign(Campaign $campaign): void
    {
        $this->campaign = $campaign;
    }

    /**
     * @return int
     */
    public function getNo(): int
    {
        return $this->no;
    }

    /**
     * @param int $no
     */
    public function setNo(int $no): void
    {
        $this->no = $no;
    }

    /**
     * @return string
     */
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

    /**
     * @return VocSType
     */
    public function getType(): VocSType
    {
        return $this->type;
    }

    /**
     * @param VocSType $type
     */
    public function setType(VocSType $type): void
    {
        $this->type = $type;
    }

    /**
     * Override site using the bucket one
     * @ORM\PrePersist
     * @param LifecycleEventArgs $event
     */
    public function setCampaignByBucket(LifecycleEventArgs $event)
    {
        if (!isset($this->campaign)) {
            $finding = $event->getEntity();
            $this->campaign = $finding->getBucket()->getCampaign();
        }
    }

}
