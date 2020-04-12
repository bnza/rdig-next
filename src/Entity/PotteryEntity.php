<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(
 *     shortName="pottery",
 *     description="Pottery archaeological finding",
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 */
class PotteryEntity extends FindingEntity
{
    /**
     * @var VocPClassEntity
     */
    private $class;

    /**
     * @var VocFColorEntity
     */
    private $coreColor;

    /**
     * @var VocPFiringEntity
     */
    private $firing;

    /**
     * @var VocPInclusionsFrequencyEntity
     */
    private $inclusionsFrequency;

    /**
     * @var VocPInclusionsSizeEntity
     */
    private $inclusionsSize;

    /**
     * @var VocPInclusionsTypeEntity
     */
    private $inclusionsType;

    /**
     * @var VocFColorEntity
     */
    private $innerColor;

    /**
     * @var VocPDecorationEntity
     */
    private $innerDecoration;

    /**
     * @var VocPSurfaceTreatmentEntity
     */
    private $innerSurfaceTreatment;

    /**
     * @var VocFColorEntity
     */
    private $outerColor;

    /**
     * @var VocPDecorationEntity
     */
    private $outerDecoration;

    /**
     * @var VocPSurfaceTreatmentEntity
     */
    private $outerSurfaceTreatment;

    /**
     * @var VocPPreservationEntity
     */
    private $preservation;

    /**
     * @var VocPShapeEntity
     */
    private $shape;

    /**
     * @var VocPTechniqueEntity
     */
    private $technique;

    /**
     * @var float
     */
    private $baseDiameter;

    /**
     * @var float
     */
    private $baseHeight;

    /**
     * @var float
     */
    private $baseWidth;

    /**
     * @var float
     */
    private $height;

    /**
     * @var float
     */
    private $maxWallDiameter;

    /**
     * @var float
     */
    private $rimDiameter;

    /**
     * @var float
     */
    private $rimWidth;

    /**
     * @var float
     */
    private $wallWidth;

    /**
     * @var string
     */
    private $drawingNumber;

    /**
     * @var bool
     */
    private $envanterlik;

    /**
     * @var bool
     */
    private $etutluk;

    /**
     * @var string
     */
    private $location;

    /**
     * @var bool
     */
    private $restored;

    public function isEnvanterlik(): bool
    {
        return $this->envanterlik;
    }

    /**
     * @param bool $envanterlik
     */
    public function setEnvanterlik($envanterlik): void
    {
        $this->envanterlik = (bool) $envanterlik;
    }

    public function isEtutluk(): bool
    {
        return $this->etutluk;
    }

    /**
     * @param bool $etutluk
     */
    public function setEtutluk($etutluk): void
    {
        $this->etutluk = (bool) $etutluk;
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

    public function getDrawingNumber(): string
    {
        return $this->drawingNumber;
    }

    /**
     * @param string $drawingNumber
     */
    public function setDrawingNumber($drawingNumber): void
    {
        $drawingNumber = '' === $drawingNumber ? null : $drawingNumber;
        $this->drawingNumber = $drawingNumber;
    }

    public function isRestored(): bool
    {
        return $this->restored;
    }

    /**
     * @param $restored
     */
    public function setRestored($restored): void
    {
        $this->restored = (bool) $restored;
    }

    public function getRimDiameter(): float
    {
        return $this->rimDiameter;
    }

    /**
     * @param float $rimDiameter
     */
    public function setRimDiameter($rimDiameter)
    {
        $this->rimDiameter = $this->castNumeric($rimDiameter, 'float');
    }

    public function getRimWidth(): float
    {
        return $this->rimWidth;
    }

    /**
     * @param float $rimWidth
     */
    public function setRimWidth($rimWidth)
    {
        $this->rimWidth = $this->castNumeric($rimWidth, 'float');
    }

    public function getWallWidth(): float
    {
        return $this->wallWidth;
    }

    /**
     * @param float $wallWidth
     */
    public function setWallWidth($wallWidth)
    {
        $this->wallWidth = $this->castNumeric($wallWidth, 'float');
    }

    public function getMaxWallDiameter(): float
    {
        return $this->maxWallDiameter;
    }

    /**
     * @param float $maxWallDiameter
     */
    public function setMaxWallDiameter($maxWallDiameter)
    {
        $this->maxWallDiameter = $this->castNumeric($maxWallDiameter, 'float');
    }

    public function getBaseWidth(): float
    {
        return $this->baseWidth;
    }

    /**
     * @param float $baseWidth
     */
    public function setBaseWidth($baseWidth)
    {
        $this->baseWidth = $this->castNumeric($baseWidth, 'float');
    }

    public function getBaseHeight(): float
    {
        return $this->baseHeight;
    }

    /**
     * @param float $baseHeight
     */
    public function setBaseHeight($baseHeight)
    {
        $this->baseHeight = $this->castNumeric($baseHeight, 'float');
    }

    public function getBaseDiameter(): float
    {
        return $this->baseDiameter;
    }

    /**
     * @param float $baseDiameter
     */
    public function setBaseDiameter($baseDiameter)
    {
        $this->baseDiameter = $this->castNumeric($baseDiameter, 'float');
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

    public function getFiring(): VocPFiringEntity
    {
        return $this->firing;
    }

    /**
     * @param VocPFiringEntity $firing
     */
    public function setFiring(VocPFiringEntity $firing = null): void
    {
        $this->firing = $firing;
    }

    public function getClass(): VocPClassEntity
    {
        return $this->class;
    }

    /**
     * @param VocPClassEntity $class
     */
    public function setClass(VocPClassEntity $class = null): void
    {
        $this->class = $class;
    }

    public function getCoreColor(): VocFColorEntity
    {
        return $this->coreColor;
    }

    /**
     * @param VocFColorEntity $coreColor
     */
    public function setCoreColor(VocFColorEntity $coreColor = null): void
    {
        $this->coreColor = $coreColor;
    }

    public function getInnerColor(): VocFColorEntity
    {
        return $this->innerColor;
    }

    /**
     * @param VocFColorEntity $innerColor
     */
    public function setInnerColor(VocFColorEntity $innerColor = null): void
    {
        $this->innerColor = $innerColor;
    }

    public function getOuterColor(): VocFColorEntity
    {
        return $this->outerColor;
    }

    /**
     * @param VocFColorEntity $outerColor
     */
    public function setOuterColor(VocFColorEntity $outerColor = null): void
    {
        $this->outerColor = $outerColor;
    }

    public function getInnerDecoration(): VocPDecorationEntity
    {
        return $this->innerDecoration;
    }

    /**
     * @param VocPDecorationEntity $innerDecoration
     */
    public function setInnerDecoration(VocPDecorationEntity $innerDecoration = null): void
    {
        $this->innerDecoration = $innerDecoration;
    }

    public function getOuterDecoration(): VocPDecorationEntity
    {
        return $this->outerDecoration;
    }

    public function getInclusionsFrequency(): VocPInclusionsFrequencyEntity
    {
        return $this->inclusionsFrequency;
    }

    /**
     * @param VocPInclusionsFrequencyEntity $inclusionFrequency
     */
    public function setInclusionsFrequency(VocPInclusionsFrequencyEntity $inclusionFrequency = null): void
    {
        $this->inclusionsFrequency = $inclusionFrequency;
    }

    public function getInclusionsSize(): VocPInclusionsSizeEntity
    {
        return $this->inclusionsSize;
    }

    /**
     * @param VocPInclusionsSizeEntity $inclusionsSize
     */
    public function setInclusionsSize(VocPInclusionsSizeEntity $inclusionsSize = null): void
    {
        $this->inclusionsSize = $inclusionsSize;
    }

    public function getInclusionsType(): VocPInclusionsTypeEntity
    {
        return $this->inclusionsType;
    }

    /**
     * @param VocPInclusionsTypeEntity $inclusionsType
     */
    public function setInclusionsType(VocPInclusionsTypeEntity $inclusionsType = null): void
    {
        $this->inclusionsType = $inclusionsType;
    }

    /**
     * @param VocPDecorationEntity $outerDecoration
     */
    public function setOuterDecoration(VocPDecorationEntity $outerDecoration = null): void
    {
        $this->outerDecoration = $outerDecoration;
    }

    public function getPreservation(): VocPPreservationEntity
    {
        return $this->preservation;
    }

    /**
     * @param VocPPreservationEntity $preservation
     */
    public function setPreservation(VocPPreservationEntity $preservation = null): void
    {
        $this->preservation = $preservation;
    }

    public function getShape(): VocPShapeEntity
    {
        return $this->shape;
    }

    /**
     * @param VocPShapeEntity $shape
     */
    public function setShape(VocPShapeEntity $shape = null): void
    {
        $this->shape = $shape;
    }

    public function getTechnique(): VocPTechniqueEntity
    {
        return $this->technique;
    }

    /**
     * @param VocPTechniqueEntity $technique
     */
    public function setTechnique(VocPTechniqueEntity $technique = null): void
    {
        $this->technique = $technique;
    }

    public function getInnerSurfaceTreatment(): VocPSurfaceTreatmentEntity
    {
        return $this->innerSurfaceTreatment;
    }

    /**
     * @param VocPSurfaceTreatmentEntity $innerSurfaceTreatment
     */
    public function setInnerSurfaceTreatment(VocPSurfaceTreatmentEntity $innerSurfaceTreatment = null): void
    {
        $this->innerSurfaceTreatment = $innerSurfaceTreatment;
    }

    public function getOuterSurfaceTreatment(): VocPSurfaceTreatmentEntity
    {
        return $this->outerSurfaceTreatment;
    }

    /**
     * @param VocPSurfaceTreatmentEntity $outerSurfaceTreatment
     */
    public function setOuterSurfaceTreatment(VocPSurfaceTreatmentEntity $outerSurfaceTreatment = null): void
    {
        $this->outerSurfaceTreatment = $outerSurfaceTreatment;
    }
}
