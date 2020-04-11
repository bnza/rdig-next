<?php

namespace App\DataFixtures\Faker\Provider;

use App\Entity\UserEntity;
use Faker\Generator;
use Faker\Provider\Base as BaseProvider;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UserProvider extends BaseProvider
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(Generator $generator, UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        parent::__construct($generator);
    }

    public static function uuid4(): string
    {
        return Uuid::uuid4();
    }

    public function encode(UserEntity $user, string $password): string
    {
        return $this->encoder->encodePassword($user, $password);
    }
}
