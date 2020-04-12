<?php

namespace App\Tests\Functional\Controller;

use App\Tests\Helper\TestFixturesLoaderTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    use TestFixturesLoaderTrait;

    public function dataProvider(): array
    {
        return  [
            'site' => [
                '/api/sites?page=1',
                [
                    [
                        'App\\Controller\\ApiController',
                        'site_get.yml',
                    ],
                ],
            ],
            'area' => [
                '/api/areas?page=1',
                [
                    [
                        'App\\Controller\\ApiController',
                        'site_get.yml',
                    ],
                    [
                        'App\\Controller\\ApiController',
                        'area_get.yml',
                    ],
                ],
            ],
            'campaign' => [
                '/api/campaigns?page=1',
                [
                    [
                        'App\\Controller\\ApiController',
                        'site_get.yml',
                    ],
                    [
                        'App\\Controller\\ApiController',
                        'campaign_get.yml',
                    ],
                ],
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testApiGet(string $uri, array $fixures)
    {
        $objects = $this->loadFixtures($fixures);

        $this->getBrowser()->request(
            'GET',
            $uri,
            [],
            [],
            ['HTTP_ACCEPT' => 'application/ld+json']
        );

        $this->assertEquals(200, $this->getBrowser()->getResponse()->getStatusCode());
    }
}
