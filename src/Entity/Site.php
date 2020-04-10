<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity()
 * @UniqueEntity(
 *      fields={"code"},
 *      message="Duplicate site code"
 * )
 */
class Site implements SiteRelateEntityInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *  @Assert\Length(
     *      min = 2,
     *      max = 2
     * )
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=2, unique=true, nullable=false)
     */
    private $code;

    /**
     * @Assert\Length(
     *      max = 64
     * )
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=64, nullable=false)
     */
    private $name;

    /**
     * @var userSites[]
     *                  One Sites have Many allowed users
     * @ORM\OneToMany(targetEntity="UserSites", mappedBy="site")
     */
    private $allowedUsers;

    /**
     * @var area[]
     *             One Site has Many Areas
     * @ORM\OneToMany(targetEntity="Area", mappedBy="site")
     */
    private $areas;

    /**
     * @var context[]
     *                One Site has Many Areas
     * @ORM\OneToMany(targetEntity="Context", mappedBy="site")
     */
    private $contexts;

    /**
     * @var campaign[]
     *                 One Site has Many Areas
     * @ORM\OneToMany(targetEntity="Campaign", mappedBy="site")
     */
    private $campaigns;

    /**
     * @var phase[]
     *              One Site has Many Areas
     * @ORM\OneToMany(targetEntity="Phase", mappedBy="site")
     */
    private $phases;

    public function __construct()
    {
        $this->allowedUsers = new ArrayCollection();
        $this->areas = new ArrayCollection();
        $this->contexts = new ArrayCollection();
        $this->campaigns = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getAreas()
    {
        return $this->areas;
    }

    public function addArea(Area $area)
    {
        $this->areas[] = $area;
        $area->setSite($this);
    }

//    /**
//     * @return ArrayCollection
//     */
//    public function getContexts()
//    {
//        return $this->contexts;
//    }
//
//    /**
//     * @param Context $context
//     */
//    public function addContexts(Context $context)
//    {
//        $this->contexts[] = $context;
//        $context->setSite($this);
//    }
//    }
//
//    public function removeUser(User $user)
//    {
//        $this->users->removeElement($user);
//    }

    public function getId(): int
    {
        return $this->id;
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
        $this->code = strtoupper($code);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getSiteId(): int
    {
        return $this->getId();
    }
}
