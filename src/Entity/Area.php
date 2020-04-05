<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity()
 * @ORM\Table(uniqueConstraints={
 *      @ORM\UniqueConstraint(columns={"code", "site"}),
 *      @ORM\UniqueConstraint(columns={"name", "site"}),
 * })
 * @UniqueEntity(
 *      fields={"code", "site"},
 *      message="Duplicate area code for this site"
 * )
 * @UniqueEntity(
 *      fields={"name", "site"},
 *      message="Duplicate area name for this site"
 * )
 */
class Area implements SiteRelateEntityInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *  @Assert\Length(
     *      max = 4
     * )
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=4, nullable=false)
     */
    private $code;

    /**
     * @Assert\Length(
     *      max = 255
     * )
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @Assert\Length(
     *      max = 255
     * )
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @var Site
     * Many Areas have One Site.
     * @ORM\ManyToOne(targetEntity="Site", inversedBy="areas")
     * @ORM\JoinColumn(name="site", referencedColumnName="id", nullable=false, onDelete="NO ACTION")
     */
    private $site;

    /**
     * One Area has Many Contexts.
     * @ORM\OneToMany(targetEntity="Context", mappedBy="area")
     */
    private $contexts;

    public function __construct() {
        $this->contexts = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param Site $site
     */
    public function setSite($site): void
    {
        $this->site = $site;
    }

    public function getSiteId(): int
    {
        return $this->site->getId();
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location): void
    {
        $this->location = $location;
    }

    /**
     * @return ArrayCollection
     */
    public function getContexts()
    {
        return $this->contexts;
    }

    /**
     * @param Context $context
     * @throws \Exception
     */
    public function addContexts(Context $context)
    {
        $this->contexts[] = $context;
        $context->setArea($this);
    }
}
