<?php

namespace App\Tests\Functional\Controller;

use App\Tests\Helper\TestFixturesLoaderTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    use TestFixturesLoaderTrait;

    public function testLoginCheckPostRoute()
    {
        $this->loadFixtures([
                [
                    'App\\Controller\\SecurityController',
                    'fixture.yml',
                ],
            ]
        );

        $this->getBrowser()->request(
            'POST',
            '/api/login_check',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"username":"theUser","password":"thePassword"}'
        );

        $this->assertEquals(200, $this->getBrowser()->getResponse()->getStatusCode());
    }
}
