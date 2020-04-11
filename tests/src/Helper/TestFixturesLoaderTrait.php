<?php

namespace App\Tests\Helper;

use Fidry\AliceDataFixtures\LoaderInterface;
use Fidry\AliceDataFixtures\Persistence\PurgeMode;
use Symfony\Component\BrowserKit\AbstractBrowser;

trait TestFixturesLoaderTrait
{
    /**
     * @var AbstractBrowser
     */
    private $browser;

    /**
     * @var LoaderInterface
     */
    private $loader;

    /**
     * @see \Symfony\Bundle\FrameworkBundle\Test\WebTestCase::createClient()
     * {@inheritdoc}
     */
    abstract protected static function createClient(array $options = [], array $server = []);

    private function getBrowser(array $options = [], array $server = []): AbstractBrowser
    {
        if (!$this->browser) {
            $this->browser = static::createClient($options, $server);
        }

        return $this->browser;
    }

    private function getLoader(): LoaderInterface
    {
        if (!$this->loader) {
            /**
             * @var \Symfony\Component\DependencyInjection\ContainerInterface
             */
            $container = $this->getBrowser()->getContainer();
            $this->loader = $container->get('fidry_alice_data_fixtures.loader.doctrine');
        }

        return $this->loader;
    }

    /**
     * @see LoaderInterface::load()
     * {@inheritdoc}
     */
    private function loadFixtures(array $fixtures, array $parameters = [], array $objects = [], PurgeMode $purgeMode = null): array
    {
        $fixtureFiles = [];
        foreach ($fixtures as $fixture) {
            if (is_array($fixture)) {
                $fixture = TestFileLocator::classToTestDataPath(...$fixture);
            }

            if (is_string($fixture)) {
                $fixtureFiles[] = $fixture;
                continue;
            }

            throw new \InvalidArgumentException('Invalid fixture: '.gettype($fixture));
        }

        return $this->getLoader()->load($fixtureFiles);
    }
}
