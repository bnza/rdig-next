<?php

namespace App\Tests\Functional\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * @group need-redump
 */
class SetupTestDatabaseCommandTest extends KernelTestCase
{
    public function testExecuteWithoutParams()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app:test:setup-db');
        $commandTester = new CommandTester($command);
        $returnCode = $commandTester->execute([]);
        $this->assertEquals(0, $returnCode, 'Non 0 exit code');
    }
}
