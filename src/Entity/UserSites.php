<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="users_allowed_sites")
 */
class UserSites
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var site
     *           Many Areas have One Site
     * @ORM\ManyToOne(targetEntity="Site", inversedBy="allowedUsers")
     * @ORM\JoinColumn(name="site", referencedColumnName="id", nullable=false, onDelete="NO ACTION")
     */
    private $site;

    /**
     * @var user
     *           Many Areas have One Site
     * @ORM\ManyToOne(targetEntity="User", inversedBy="allowedSites")
     * @ORM\JoinColumn(name="site", referencedColumnName="uuid", nullable=false, onDelete="NO ACTION")
     */
    private $user;
}
