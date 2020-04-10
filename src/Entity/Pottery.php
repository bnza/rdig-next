<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="pottery", uniqueConstraints={
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
class Pottery extends AbstractFinding
{
    /**
     * @var VocPClass
     * @ORM\ManyToOne(targetEntity="VocPClass")
     * @ORM\JoinColumn(name="class", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $class;

    /**
     * @var VocFColor
     * @ORM\ManyToOne(targetEntity="VocFColor")
     * @ORM\JoinColumn(name="core_color", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $coreColor;

    /**
     * @var VocPFiring
     * @ORM\ManyToOne(targetEntity="VocPFiring")
     * @ORM\JoinColumn(name="firing", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $firing;

    /**
     * @var VocPInclusionsFrequency
     * @ORM\ManyToOne(targetEntity="VocPInclusionsFrequency")
     * @ORM\JoinColumn(name="inclusions_frequency", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $inclusionsFrequency;

    /**
     * @var VocPInclusionsSize
     * @ORM\ManyToOne(targetEntity="VocPInclusionsSize")
     * @ORM\JoinColumn(name="inclusions_size", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $inclusionsSize;

    /**
     * @var VocPInclusionsType
     * @ORM\ManyToOne(targetEntity="VocPInclusionsType")
     */
    private $inclusionsType;

    /**
     * @var VocFColor
     * @ORM\ManyToOne(targetEntity="VocFColor")
     * @ORM\JoinColumn(name="inner_color", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $innerColor;

    /**
     * @var VocPDecoration
     * @ORM\ManyToOne(targetEntity="VocPDecoration")
     * @ORM\JoinColumn(name="inner_decoration", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $innerDecoration;

    /**
     * @var VocPSurfaceTreatment
     * @ORM\ManyToOne(targetEntity="VocPSurfaceTreatment")
     * @ORM\JoinColumn(name="inner_surface_treatment", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $innerSurfaceTreatment;

    /**
     * @var VocFColor
     * @ORM\ManyToOne(targetEntity="VocFColor")
     * @ORM\JoinColumn(name="outer_color", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $outerColor;

    /**
     * @var VocPDecoration
     * @ORM\ManyToOne(targetEntity="VocPDecoration")
     * @ORM\JoinColumn(name="inner_decoration", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $outerDecoration;

    /**
     * @var VocPSurfaceTreatment
     * @ORM\ManyToOne(targetEntity="VocPSurfaceTreatment")
     * @ORM\JoinColumn(name="outer_surface_treatment", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $outerSurfaceTreatment;

    /**
     * @var VocPPreservation
     * @ORM\ManyToOne(targetEntity="VocPPreservation")
     * @ORM\JoinColumn(name="preservation", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $preservation;

    /**
     * @var VocPShape
     * @ORM\ManyToOne(targetEntity="VocPShape")
     * @ORM\JoinColumn(name="shape", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $shape;

    /**
     * @var VocPTechnique
     * @ORM\ManyToOne(targetEntity="VocPTechnique")
     * @ORM\JoinColumn(name="technique", referencedColumnName="id", onDelete="NO ACTION")
     */
    private $technique;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $baseDiameter;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $baseHeight;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $baseWidth;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $height;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $maxWallDiameter;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $rimDiameter;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $rimWidth;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $wallWidth;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $drawingNumber;

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

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $location;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=true)
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

    public function getFiring(): VocPFiring
    {
        return $this->firing;
    }

    /**
     * @param VocPFiring $firing
     */
    public function setFiring(VocPFiring $firing = null): void
    {
        $this->firing = $firing;
    }

    public function getClass(): VocPClass
    {
        return $this->class;
    }

    /**
     * @param VocPClass $class
     */
    public function setClass(VocPClass $class = null): void
    {
        $this->class = $class;
    }

    public function getCoreColor(): VocFColor
    {
        return $this->coreColor;
    }

    /**
     * @param VocFColor $coreColor
     */
    public function setCoreColor(VocFColor $coreColor = null): void
    {
        $this->coreColor = $coreColor;
    }

    public function getInnerColor(): VocFColor
    {
        return $this->innerColor;
    }

    /**
     * @param VocFColor $innerColor
     */
    public function setInnerColor(VocFColor $innerColor = null): void
    {
        $this->innerColor = $innerColor;
    }

    public function getOuterColor(): VocFColor
    {
        return $this->outerColor;
    }

    /**
     * @param VocFColor $outerColor
     */
    public function setOuterColor(VocFColor $outerColor = null): void
    {
        $this->outerColor = $outerColor;
    }

    public function getInnerDecoration(): VocPDecoration
    {
        return $this->innerDecoration;
    }

    /**
     * @param VocPDecoration $innerDecoration
     */
    public function setInnerDecoration(VocPDecoration $innerDecoration = null): void
    {
        $this->innerDecoration = $innerDecoration;
    }

    public function getOuterDecoration(): VocPDecoration
    {
        return $this->outerDecoration;
    }

    public function getInclusionsFrequency(): VocPInclusionsFrequency
    {
        return $this->inclusionsFrequency;
    }

    /**
     * @param VocPInclusionsFrequency $inclusionFrequency
     */
    public function setInclusionsFrequency(VocPInclusionsFrequency $inclusionFrequency = null): void
    {
        $this->inclusionsFrequency = $inclusionFrequency;
    }

    public function getInclusionsSize(): VocPInclusionsSize
    {
        return $this->inclusionsSize;
    }

    /**
     * @param VocPInclusionsSize $inclusionsSize
     */
    public function setInclusionsSize(VocPInclusionsSize $inclusionsSize = null): void
    {
        $this->inclusionsSize = $inclusionsSize;
    }

    public function getInclusionsType(): VocPInclusionsType
    {
        return $this->inclusionsType;
    }

    /**
     * @param VocPInclusionsType $inclusionsType
     */
    public function setInclusionsType(VocPInclusionsType $inclusionsType = null): void
    {
        $this->inclusionsType = $inclusionsType;
    }

    /**
     * @param VocPDecoration $outerDecoration
     */
    public function setOuterDecoration(VocPDecoration $outerDecoration = null): void
    {
        $this->outerDecoration = $outerDecoration;
    }

    public function getPreservation(): VocPPreservation
    {
        return $this->preservation;
    }

    /**
     * @param VocPPreservation $preservation
     */
    public function setPreservation(VocPPreservation $preservation = null): void
    {
        $this->preservation = $preservation;
    }

    public function getShape(): VocPShape
    {
        return $this->shape;
    }

    /**
     * @param VocPShape $shape
     */
    public function setShape(VocPShape $shape = null): void
    {
        $this->shape = $shape;
    }

    public function getTechnique(): VocPTechnique
    {
        return $this->technique;
    }

    /**
     * @param VocPTechnique $technique
     */
    public function setTechnique(VocPTechnique $technique = null): void
    {
        $this->technique = $technique;
    }

    public function getInnerSurfaceTreatment(): VocPSurfaceTreatment
    {
        return $this->innerSurfaceTreatment;
    }

    /**
     * @param VocPSurfaceTreatment $innerSurfaceTreatment
     */
    public function setInnerSurfaceTreatment(VocPSurfaceTreatment $innerSurfaceTreatment = null): void
    {
        $this->innerSurfaceTreatment = $innerSurfaceTreatment;
    }

    public function getOuterSurfaceTreatment(): VocPSurfaceTreatment
    {
        return $this->outerSurfaceTreatment;
    }

    /**
     * @param VocPSurfaceTreatment $outerSurfaceTreatment
     */
    public function setOuterSurfaceTreatment(VocPSurfaceTreatment $outerSurfaceTreatment = null): void
    {
        $this->outerSurfaceTreatment = $outerSurfaceTreatment;
    }
}
