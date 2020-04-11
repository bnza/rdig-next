<?php

namespace App\Tests\Functional\Controller;

use App\Tests\Helper\TestFileLocator;
use Nelmio\Alice\Loader\NativeLoader;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    /**
     * @var NativeLoader
     */
    private $loader;

    public function setUp()
    {
        $this->loader = new NativeLoader();
    }

    public function testShowPost()
    {
        $fixtures = TestFileLocator::classToTestDataPath(
            'App\\Controller\\SecurityController',
            TestFileLocator::TEST_MODE_FUNCTIONAL,
            'fixture.yml'
        );

        $client = static::createClient();

        $loader = $client->getContainer()->get('fidry_alice_data_fixtures.loader.doctrine');
        $loader->load([$fixtures]);

        $client->request(
            'POST',
            '/api/login_check',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"username":"theUser","password":"thePassword"}'
            );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
