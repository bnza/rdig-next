<?php

namespace App\Tests\Service\Helper;

use App\Service\Helper\MysqlCli\AbstractMysqlCliExecutor;

class AbstractMysqlExecutorTest extends \PHPUnit\Framework\TestCase
{
    public function dataProvider(): array
    {
        return [
            'minimal' => ['@--defaults-extra-file=/tmp/rDig\w{6} dbname2@', 'mysql://user@localhost/dbname2'],
            'full' => ['@--defaults-extra-file=/tmp/rDig\w{6} dbname3@', 'mysql://user:password@localhost:3306/dbname3'],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testMethodFormat(
        string $expected,
        string $databaseUrl
    ) {
        $executor = $this->getMockForAbstractClass(
            AbstractMysqlCliExecutor::class,
            [$databaseUrl]
        );
        $executor->expects($this->once())->method('getCommandName')->willReturn('echo');

        $output = $executor->execute([]);
        $this->assertRegExp($expected, $output[0]);
    }
}
