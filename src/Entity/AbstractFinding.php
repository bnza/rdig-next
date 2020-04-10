<?php

namespace App\Entity;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="finding", uniqueConstraints={
 *      @ORM\UniqueConstraint(columns={"bucket", "discr", "num"})
 * })
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string", length=1)
 * @ORM\DiscriminatorMap({"O" = "ObjectEntity", "P" = "Pottery", "S" = "Sample"})
 * @UniqueEntity(
 *      fields={"bucket", "num"},
 *      errorPath="num",
 *      message="Duplicate field number [{{ value }}] for this finding type in this bucket "
 * )
 * @ORM\HasLifecycleCallbacks()
 */
abstract class AbstractFinding implements SiteRelateEntityInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Bucket
     *             Many Buckets have One Campaign
     * @ORM\ManyToOne(targetEntity="Bucket", inversedBy="findings")
     * @ORM\JoinColumn(name="bucket", referencedColumnName="id", nullable=false, onDelete="NO ACTION")
     */
    private $bucket;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 1,
     *     max = 4,
     *     maxMessage = "Bucket num must be at least {{ limit }} characters long",
     *     maxMessage = "Bucket num cannot be longer than {{ limit }} characters"
     *     )
     * @ORM\Column(type="string", length=4, nullable=false)
     */
    private $num;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $remarks;

    /**
     * @var VocFChronology
     * @ORM\ManyToOne(targetEntity="VocFChronology")
     * @ORM\JoinColumn(name="chronology", referencedColumnName="id", nullable=true, onDelete="NO ACTION")
     */
    private $chronology;

    public function getChronology(): VocFChronology
    {
        return $this->chronology;
    }

    /**
     * @param VocFChronology $chronology
     */
    public function setChronology(VocFChronology $chronology = null): void
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

    public function getBucket(): Bucket
    {
        return $this->bucket;
    }

    public function setBucket(Bucket $bucket): void
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
//            throw new \InvalidArgumentException("Finding num must be max 4 char length $num given");
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
