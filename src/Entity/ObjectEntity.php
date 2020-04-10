<?php

namespace App\Entity;

use App\Exceptions\CrudException;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="object", uniqueConstraints={
 *      @ORM\UniqueConstraint(columns={"campaign", "no", "duplicate"})
 * })
 *
 * @UniqueEntity(
 *      fields={"campaign", "no", "duplicate"},
 *      errorPath="no",
 *      message="Duplicate registration number [{{ value }}] for this campaign"
 * )
 *
 * @ORM\HasLifecycleCallbacks()
 */
class ObjectEntity extends AbstractFinding
{
    /**
     * @var Campaign
     * @ORM\ManyToOne(targetEntity="Campaign")
     * @ORM\JoinColumn(name="campaign", referencedColumnName="id", nullable=false, onDelete="NO ACTION")
     */
    private $campaign;

    /**
     * Registration number.
     *
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $no;

    /**
     * @ORM\Column(
     *      type="string",
     *      length=1,
     *      nullable=true,
     *      options={
     *     "fixed" = true
     *     })
     */
    private $duplicate;

    /**
     * @var float
     * @Assert\Type("float")
     * @ORM\Column(type="float", nullable=true)
     */
    private $height;

    /**
     * @var float
     * @Assert\Type("float")
     * @ORM\Column(type="float", nullable=true)
     */
    private $length;

    /**
     * @var float
     * @Assert\Type("float")
     * @ORM\Column(type="float", nullable=true)
     */
    private $width;

    /**
     * @var float
     * @Assert\Type("float")
     * @ORM\Column(type="float", nullable=true)
     */
    private $thickness;

    /**
     * @var float
     * @Assert\Type("float")
     * @ORM\Column(type="float", nullable=true)
     */
    private $diameter;

    /**
     * @var float
     * @Assert\Type("float")
     * @ORM\Column(type="float", nullable=true)
     */
    private $perforationDiameter;

    /**
     * @var float
     * @Assert\Type("float")
     * @ORM\Column(type="float", nullable=true)
     */
    private $weight;

    /**
     * @var VocOClass
     * @ORM\ManyToOne(targetEntity="VocOClass")
     * @ORM\JoinColumn(name="class", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $class;

    /**
     * @var VocOMaterialClass
     * @ORM\ManyToOne(targetEntity="VocOMaterialClass")
     * @ORM\JoinColumn(name="material_class", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $materialClass;

    /**
     * @var VocOMaterialType
     * @ORM\ManyToOne(targetEntity="VocOMaterialType")
     * @ORM\JoinColumn(name="material_type", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $materialType;

    /**
     * @var VocOTechnique
     * @ORM\ManyToOne(targetEntity="VocOTechnique")
     * @ORM\JoinColumn(name="technique", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $technique;

    /**
     * @var VocOType
     * @ORM\ManyToOne(targetEntity="VocOType")
     * @ORM\JoinColumn(name="type", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @ORM\JoinColumn(name="sub_type", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $subType;

    /**
     * @var VocFColor
     * @ORM\ManyToOne(targetEntity="VocFColor")
     * @ORM\JoinColumn(name="color", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $color;

    /**
     * @var VocOPreservation
     * @ORM\ManyToOne(targetEntity="VocOPreservation")
     * @ORM\JoinColumn(name="preservation", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $preservation;

    /**
     * @var VocODecoration
     * @ORM\ManyToOne(targetEntity="VocODecoration")
     * @ORM\JoinColumn(name="decoration", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $decoration;

    /**
     * @var \DateTime
     * @ORM\Column(type="date", nullable=true)
     */
    private $retrievalDate;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $inscription;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @Assert\Range(
     *     min = 2000,
     *     max = 2099,
     *     minMessage = "Campaign's year lower limit is {{ limit }}",
     *     maxMessage = "Campaign's year upper limit is {{ limit }}"
     * )
     * @ORM\Column(
     *     type="smallint",
     *     nullable=true
     *     )
     */
    private $conservationYear;

    /**
     * @var int
     * @Assert\Type("integer")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fragments;

    /**
     * @var float
     * @Assert\Type("float")
     * @ORM\Column(type="float", nullable=true)
     */
    private $coordN;

    /**
     * @var float
     * @Assert\Type("float")
     * @ORM\Column(type="float", nullable=true)
     */
    private $coordE;

    /**
     * @var float
     * @Assert\Type("float")
     * @ORM\Column(type="float", nullable=true)
     */
    private $coordZ;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $location;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $drawing;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $photo;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $envanterlik;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $etutluk;

    public function getCampaign(): Campaign
    {
        return $this->campaign;
    }

    public function setCampaign(Campaign $campaign): void
    {
        $this->campaign = $campaign;
    }

    public function getFragments(): int
    {
        return $this->fragments;
    }

    /**
     * @param int $fragments
     */
    public function setFragments($fragments): void
    {
        $this->fragments = (int) $fragments;
    }

    /**
     * @return mixed
     */
    public function getConservationYear()
    {
        return $this->conservationYear;
    }

    /**
     * @param mixed $conservationYear
     */
    public function setConservationYear($conservationYear): void
    {
        $this->conservationYear = $conservationYear;
    }

    public function getCoordN(): float
    {
        return $this->coordN;
    }

    /**
     * @param float $coordN
     */
    public function setCoordN($coordN): void
    {
        $this->coordN = (float) $coordN;
    }

    public function getCoordE(): float
    {
        return $this->coordE;
    }

    /**
     * @param float $coordE
     */
    public function setCoordE($coordE): void
    {
        $this->coordE = (float) $coordE;
    }

    public function getCoordZ(): float
    {
        return $this->coordZ;
    }

    /**
     * @param float $coordZ
     */
    public function setCoordZ($coordZ): void
    {
        $this->coordZ = (float) $coordZ;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location): void
    {
        $this->location = $location;
    }

    public function getDrawing(): bool
    {
        return $this->drawing;
    }

    /**
     * @param mixed $drawing
     */
    public function setDrawing($drawing): void
    {
        $this->drawing = (bool) $drawing;
    }

    public function getPhoto(): bool
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo): void
    {
        $this->photo = (bool) $photo;
    }

    public function getEnvanterlik(): bool
    {
        return $this->envanterlik;
    }

    /**
     * @param mixed $envanterlik
     */
    public function setEnvanterlik($envanterlik): void
    {
        $this->envanterlik = (bool) $envanterlik;
    }

    public function getEtutluk(): bool
    {
        return $this->etutluk;
    }

    /**
     * @param mixed $etutluk
     */
    public function setEtutluk($etutluk): void
    {
        $this->etutluk = (bool) $etutluk;
    }

    public function getNo(): int
    {
        return $this->no;
    }

    /**
     * @param int $no
     */
    public function setNo($no): void
    {
        $this->no = $no;
    }

    /**
     * @return mixed
     */
    public function getDuplicate()
    {
        return $this->duplicate;
    }

    /**
     * @param mixed $duplicate
     */
    public function setDuplicate($duplicate): void
    {
        $this->duplicate = $duplicate;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * @param float $height
     */
    public function setHeight($height)
    {
        $this->height = $this->castNumeric($height, 'float');
    }

    public function getLength(): float
    {
        return $this->length;
    }

    /**
     * @param $length
     */
    public function setLength($length): void
    {
        $this->length = $this->castNumeric($length, 'float');
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * @param float $width
     */
    public function setWidth($width)
    {
        $this->width = $this->castNumeric($width, 'float');
    }

    public function getThickness(): float
    {
        return $this->thickness;
    }

    /**
     * @param float $thickness
     */
    public function setThickness($thickness)
    {
        $this->thickness = $this->castNumeric($thickness, 'float');
    }

    public function getDiameter(): float
    {
        return $this->diameter;
    }

    /**
     * @param float $diameter
     */
    public function setDiameter($diameter)
    {
        $this->diameter = $this->castNumeric($diameter, 'float');
    }

    public function getPerforationDiameter(): float
    {
        return $this->perforationDiameter;
    }

    /**
     * @param mixed $perforationDiameter
     */
    public function setPerforationDiameter($perforationDiameter)
    {
        $this->perforationDiameter = $this->castNumeric($perforationDiameter, 'float');
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $this->castNumeric($weight, 'float');
    }

    public function getClass(): VocOClass
    {
        return $this->class;
    }

    /**
     * @param VocOClass $class
     */
    public function setClass(VocOClass $class = null): void
    {
        $this->class = $class;
    }

    public function getMaterialClass(): VocOMaterialClass
    {
        return $this->materialClass;
    }

    /**
     * @param VocOMaterialClass $materialClass
     */
    public function setMaterialClass(VocOMaterialClass $materialClass = null): void
    {
        $this->materialClass = $materialClass;
    }

    public function getMaterialType(): VocOMaterialType
    {
        return $this->materialType;
    }

    /**
     * @param VocOMaterialType $materialType
     */
    public function setMaterialType(VocOMaterialType $materialType = null): void
    {
        $this->materialType = $materialType;
    }

    public function getTechnique(): VocOTechnique
    {
        return $this->technique;
    }

    /**
     * @param VocOTechnique $technique
     */
    public function setTechnique(VocOTechnique $technique = null): void
    {
        $this->technique = $technique;
    }

    public function getType(): VocOType
    {
        return $this->type;
    }

    /**
     * @param VocOType $type
     */
    public function setType(VocOType $type = null): void
    {
        $this->type = $type;
    }

    public function getSubType(): string
    {
        return $this->subType;
    }

    /**
     * @param string $subType
     */
    public function setSubType($subType): void
    {
        $this->subType = $subType;
    }

    public function getColor(): VocFColor
    {
        return $this->color;
    }

    /**
     * @param VocFColor $color
     */
    public function setColor(VocFColor $color = null): void
    {
        $this->color = $color;
    }

    public function getPreservation(): VocOPreservation
    {
        return $this->preservation;
    }

    /**
     * @param VocOPreservation $preservation
     */
    public function setPreservation(VocOPreservation $preservation = null): void
    {
        $this->preservation = $preservation;
    }

    public function getRetrievalDate(): \DateTime
    {
        return $this->retrievalDate;
    }

    /**
     * @param string|\DateTime $retrievalDate
     *
     * @throws CrudException
     */
    public function setRetrievalDate($retrievalDate): void
    {
        if ($retrievalDate && is_string($retrievalDate)) {
            $retrievalDateString = $retrievalDate;
            if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{2}$/', $retrievalDate)) {
                $retrievalDate = \DateTime::createFromFormat('d/m/y', $retrievalDateString);
                if (!$retrievalDate) {
                    throw new CrudException("Invalid date format ($retrievalDateString)");
                }
            } elseif (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $retrievalDate)) {
                $retrievalDate = \DateTime::createFromFormat('d/m/Y', $retrievalDateString);
                if (!$retrievalDate) {
                    throw new CrudException("Invalid date format ($retrievalDateString)");
                }
            } elseif (preg_match('/^\d{4}$/', $retrievalDate)) {
                $retrievalDate = null;
            } else {
                try {
                    $retrievalDate = new \DateTime($retrievalDateString);
                } catch (\Exception $e) {
                    throw new CrudException("Invalid date format ($retrievalDateString)");
                }
            }
        }
        $this->retrievalDate = $retrievalDate ? $retrievalDate : null;
    }

    public function getInscription(): string
    {
        return $this->inscription;
    }

    /**
     * @param string $inscription
     */
    public function setInscription($inscription): void
    {
        $this->inscription = $inscription;
    }

    public function getDescription(): string
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

    public function getDecoration(): VocODecoration
    {
        return $this->decoration;
    }

    /**
     * @param VocODecoration $decoration
     */
    public function setDecoration(VocODecoration $decoration = null): void
    {
        $this->decoration = $decoration;
    }

    /**
     * Override site using the bucket one.
     *
     * @ORM\PrePersist
     */
    public function setCampaignByBucket(LifecycleEventArgs $event)
    {
        if (!isset($this->campaign)) {
            $finding = $event->getEntity();
            $this->campaign = $finding->getBucket()->getCampaign();
        }
    }
}
