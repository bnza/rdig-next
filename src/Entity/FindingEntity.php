<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     shortName="finding",
 *     description="Generic archaeological finding",
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 * @UniqueEntity(
 *      fields={"bucket", "num"},
 *      errorPath="num",
 *      message="Duplicate field number [{{ value }}] for this finding type in this bucket "
 * )
 */
class FindingEntity implements SiteRelateEntityInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var BucketEntity
     */
    private $bucket;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 1,
     *     max = 4,
     *     maxMessage = "BucketEntity num must be at least {{ limit }} characters long",
     *     maxMessage = "BucketEntity num cannot be longer than {{ limit }} characters"
     *     )
     */
    private $num;

    /**
     * @var string
     */
    private $remarks;

    /**
     * @var VocFChronologyEntity
     */
    private $chronology;

    public function getChronology(): VocFChronologyEntity
    {
        return $this->chronology;
    }

    /**
     * @param VocFChronologyEntity $chronology
     */
    public function setChronology(VocFChronologyEntity $chronology = null): void
    {
        $this->chronology = $chronology;
    }

    /**
     * @return mixed
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * @param mixed $remarks
     */
    public function setRemarks($remarks): void
    {
        $this->remarks = $remarks;
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
        // Psuedo-numeric values (eg. 1, 1a) will formatted by leading zeros
        if (preg_match('/\d+[[:alpha:]]?$/', $num)) {
            $num = sprintf("%'.04s", $num);
        }
        $this->num = $num;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBucket(): BucketEntity
    {
        return $this->bucket;
    }

    public function setBucket(BucketEntity $bucket): void
    {
        $this->bucket = $bucket;
    }

    public function getSiteId(): int
    {
        return $this->bucket->getSiteId();
    }

    public function toArray(bool $ancestors = true, bool $descendants = false)
    {
        return [
          'id' => '@TODO',
        ];
    }

//    /**
//     * @ORM\PrePersist
//     * @param LifecycleEventArgs $event
//     */
//    public function formatNum(LifecycleEventArgs $event)
//    {
//        $finding = $event->getEntity();
//        $num = $finding->getNum();
//        if (strlen((string) $num) > 4) {
//            throw new \InvalidArgumentException("VwFindingEntity num must be max 4 char length $num given");
//        }
//        sprintf("%'.04s", $num);
//        $finding->setNum($num);
//    }

    public function __toString()
    {
        $bucketCode = $this->getBucket() ? (string) $this->getBucket() : 'XX.0000.X.0';
        $findingNum = $this->getNum() ? $this->getNum() : '0';

        return "$bucketCode.$findingNum";
    }

    protected function castNumeric($number, string $type = 'int', bool $throw = false)
    {
        if (is_numeric($number)) {
            switch ($type) {
                case 'int':
                case 'integer':
                    return (int) $number;
                case 'bool':
                case 'boolean':
                    return (bool) $number;
                case 'float':
                case 'double':
                case 'real':
                    return (float) $number;
                default:
                    if ($throw) {
                        throw new \InvalidArgumentException(sprintf('[%s] is not a valid number type', $number, $type));
                    }
            }
        }
        if ($throw) {
            throw new \InvalidArgumentException(sprintf('%s is not a valid [%s] number', $number, $type));
        }

        return $number;
    }
}
