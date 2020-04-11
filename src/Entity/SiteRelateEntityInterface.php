<?php
/**
 * Created by PhpStorm.
 * UserEntity: petrux
 * Date: 24/03/18
 * Time: 10.25.
 */

namespace App\Entity;

interface SiteRelateEntityInterface extends CrudEntityInterface
{
    public function getSiteId(): int;
}
