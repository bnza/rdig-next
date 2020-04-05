<?php

namespace App\Entity;

use App\Entity\CrudEntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity()
 * @ORM\Table(name="app_users")
 */
class User implements UserInterface, \Serializable, CrudEntityInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="smallint", options={"default": 0})
     */
    private $attempts = 0;

    /**
     * @ORM\Column(
     *     type="string",
     *     options={"default": "ROLE_USER"}
     * )
     */
    private $roles = 'ROLE_USER';

    /**
     * Many Users have Many Sites.
     * @ORM\ManyToMany(targetEntity="Site", inversedBy="users")
     * @ORM\JoinTable(name="users_allowed_sites")
     */
    private $sites;

    /**
     * @return ArrayCollection
     */
    public function getSites()
    {
        return $this->sites;
    }

    /**
     * @param Site $site
     */
    public function addSite(Site $site): void
    {
        $site->addUser($this); // synchronously updating inverse side
        $this->sites[] = $site;
    }

    public function removeSite(Site $site): void
    {
        $site->removeUser($this); // synchronously updating inverse side
        $this->sites->removeElement($site);
    }

    public function __construct() {
        $this->sites = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return explode(',', $this->roles);
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = implode(',', $roles);
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getSalt()
    {
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function eraseCredentials()
    {
    }

    /**
     * @return int
     */
    public function getAttempts(): int
    {
        return $this->attempts;
    }

    /**
     * @param mixed $attempts
     */
    public function setAttempts($attempts): void
    {
        $this->attempts = $attempts;
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->roles,
        ));
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password,
            $this->roles
            ) = unserialize($serialized);
    }

    /**
     * @param SiteRelateEntityInterface $entity
     * @return bool
     */
    public function isSiteAllowed(SiteRelateEntityInterface $entity): bool
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("id", $entity->getSiteId()))
            ->setMaxResults(1);
        return (bool) $this->sites->matching($criteria)->count();
    }

    public function toArray(bool $ancestors = true, bool $descendants = false)
    {
        $data = [
            'id' => $this->id,
            'username' => $this->username,
            'roles' => $this->roles
        ];

        return $data;
    }
}
