<?php

namespace App\Entity;

use Doctrine\ORM\Event\LifecycleEventArgs;

class ObjectEntity extends FindingEntity
{
    /**
     * @var CampaignEntity
     */
    private $campaign;

    /**
     * Registration number.
     *
     * @var int
     */
    private $no;

    /**
     * @var string
     */
    private $duplicate;

    /**
     * @var float
     */
    private $height;

    /**
     * @var float
     */
    private $length;

    /**
     * @var float
     */
    private $width;

    /**
     * @var float
     */
    private $thickness;

    /**
     * @var float
     */
    private $diameter;

    /**
     * @var float
     */
    private $perforationDiameter;

    /**
     * @var float
     */
    private $weight;

    /**
     * @var VocOClassEntity
     */
    private $class;

    /**
     * @var VocOMaterialClassEntity
     */
    private $materialClass;

    /**
     * @var VocOMaterialTypeEntity
     */
    private $materialType;

    /**
     * @var VocOTechniqueEntity
     */
    private $technique;

    /**
     * @var VocOTypeEntity
     */
    private $type;

    /**
     * @var string
     */
    private $subType;

    /**
     * @var VocFColorEntity
     */
    private $color;

    /**
     * @var VocOPreservationEntity
     */
    private $preservation;

    /**
     * @var VocODecorationEntity
     */
    private $decoration;

    /**
     * @var \DateTime
     */
    private $retrievalDate;

    /**
     * @var string
     */
    private $inscription;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $conservationYear;

    /**
     * @var int
     */
    private $fragments;

    /**
     * @var float
     */
    private $coordN;

    /**
     * @var float
     */
    private $coordE;

    /**
     * @var float
     */
    private $coordZ;

    /**
     * @var string
     */
    private $location;

    /**
     * @var bool
     */
    private $drawing;

    /**
     * @var bool
     */
    private $photo;

    /**
     * @var bool
     */
    private $envanterlik;

    /**
     * @var bool
     */
    private $etutluk;

    public function getCampaign(): CampaignEntity
    {
        return $this->campaign;
    }

    public function setCampaign(CampaignEntity $campaign): void
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

    public function getClass(): VocOClassEntity
    {
        return $this->class;
    }

    /**
     * @param VocOClassEntity $class
     */
    public function setClass(VocOClassEntity $class = null): void
    {
        $this->class = $class;
    }

    public function getMaterialClass(): VocOMaterialClassEntity
    {
        return $this->materialClass;
    }

    /**
     * @param VocOMaterialClassEntity $materialClass
     */
    public function setMaterialClass(VocOMaterialClassEntity $materialClass = null): void
    {
        $this->materialClass = $materialClass;
    }

    public function getMaterialType(): VocOMaterialTypeEntity
    {
        return $this->materialType;
    }

    /**
     * @param VocOMaterialTypeEntity $materialType
     */
    public function setMaterialType(VocOMaterialTypeEntity $materialType = null): void
    {
        $this->materialType = $materialType;
    }

    public function getTechnique(): VocOTechniqueEntity
    {
        return $this->technique;
    }

    /**
     * @param VocOTechniqueEntity $technique
     */
    public function setTechnique(VocOTechniqueEntity $technique = null): void
    {
        $this->technique = $technique;
    }

    public function getType(): VocOTypeEntity
    {
        return $this->type;
    }

    /**
     * @param VocOTypeEntity $type
     */
    public function setType(VocOTypeEntity $type = null): void
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

    public function getColor(): VocFColorEntity
    {
        return $this->color;
    }

    /**
     * @param VocFColorEntity $color
     */
    public function setColor(VocFColorEntity $color = null): void
    {
        $this->color = $color;
    }

    public function getPreservation(): VocOPreservationEntity
    {
        return $this->preservation;
    }

    /**
     * @param VocOPreservationEntity $preservation
     */
    public function setPreservation(VocOPreservationEntity $preservation = null): void
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

    public function getDecoration(): VocODecorationEntity
    {
        return $this->decoration;
    }

    /**
     * @param VocODecorationEntity $decoration
     */
    public function setDecoration(VocODecorationEntity $decoration = null): void
    {
        $this->decoration = $decoration;
    }

    public function setCampaignByBucket(LifecycleEventArgs $event)
    {
        if (!isset($this->campaign)) {
            $finding = $event->getEntity();
            $this->campaign = $finding->getBucket()->getCampaign();
        }
    }
}
