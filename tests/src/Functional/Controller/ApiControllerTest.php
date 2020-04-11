<?php


namespace App\Tests\Functional\Controller;

use App\Tests\Helper\TestFixturesLoaderTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    use TestFixturesLoaderTrait;

    public function testGetSites()
    {
        $this->loadFixtures([
                [
                    'App\\Controller\\ApiController',
                    'site_get.yml',
                ],
            ]
        );

        $this->getBrowser()->request(
            'GET',
            '/api/sites?page=1',
            [],
            [],
            ['HTTP_ACCEPT' => 'application/ld+json']
        );

        $this->assertEquals(200, $this->getBrowser()->getResponse()->getStatusCode());
    }
}
