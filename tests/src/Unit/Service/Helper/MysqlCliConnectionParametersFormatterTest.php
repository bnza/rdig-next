<?php

namespace App\Tests\Service\Helper;

use App\Service\Helper\MysqlCli\MysqlCliConnectionParametersFormatter;

class MysqlCliConnectionParametersFormatterTest extends \PHPUnit\Framework\TestCase
{
    public function dataProvider(): array
    {
        return [
            'minimal' => [' -hlocalhost -uuser dbname', 'mysql://user@localhost/dbname'],
            'full' => [' -hlocalhost -P3306 -uuser -ppassword dbname', 'mysql://user:password@localhost:3306/dbname'],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testMethodFormat(
        string $expected,
        string $databaseUrl
    ) {
        $formatter = new MysqlCliConnectionParametersFormatter($databaseUrl);
        $this->assertEquals($expected, $formatter->format());
    }
}
