<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\Security\Core\User\UserInterface;

class UserEntity implements UserInterface, \Serializable
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var int
     */
    private $attempts = 0;

    /**
     * @var string
     */
    private $roles = 'ROLE_USER';

    /**
     * @var UsersSitesJoinEntity[]
     */
    private $allowedSites;

    /**
     * @return ArrayCollection
     */
    public function getAllowedSites()
    {
        return $this->allowedSites;
    }

//    /**
//     * @param SiteEntity $site
//     */
//    public function addSite(SiteEntity $site): void
//    {
//        $site->addUser($this); // synchronously updating inverse side
//        $this->sites[] = $site;
//    }
//
//    public function removeSite(SiteEntity $site): void
//    {
//        $site->removeUser($this); // synchronously updating inverse side
//        $this->sites->removeElement($site);
//    }

    public function __construct()
    {
        $this->allowedSites = new ArrayCollection();
    }

    public function getUuid(): int
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return explode(',', $this->roles);
    }

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
        return serialize([
            $this->id,
            $this->username,
            $this->password,
            $this->roles,
        ]);
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

    public function isSiteAllowed(SiteRelateEntityInterface $entity): bool
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('id', $entity->getSiteId()))
            ->setMaxResults(1);

        return (bool) $this->sites->matching($criteria)->count();
    }

    public function toArray(bool $ancestors = true, bool $descendants = false)
    {
        $data = [
            'id' => $this->id,
            'username' => $this->username,
            'roles' => $this->roles,
        ];

        return $data;
    }
}
