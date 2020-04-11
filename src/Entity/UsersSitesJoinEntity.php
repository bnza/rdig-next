<?php

namespace App\Entity;

class UsersSitesJoinEntity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var SiteEntity
     */
    private $site;

    /**
     * @var UserEntity
     */
    private $user;

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
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return SiteEntity
     */
    public function getSite(): SiteEntity
    {
        return $this->site;
    }

    /**
     * @param SiteEntity $site
     */
    public function setSite(SiteEntity $site): void
    {
        $this->site = $site;
    }

    /**
     * @return UserEntity
     */
    public function getUser(): UserEntity
    {
        return $this->user;
    }

    /**
     * @param UserEntity $user
     */
    public function setUser(UserEntity $user): void
    {
        $this->user = $user;
    }

}
