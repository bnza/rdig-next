<?php

namespace App\Tests\Functional\Service\Helper\MysqlCli;

use App\Service\Helper\MysqlCli\MysqlCliConnectionParametersFormatter;
use App\Service\Helper\MysqlCli\MysqlCliDumpRestorer;
use App\Service\Helper\MysqlCli\MysqlCliExecutor;
use App\Tests\Helper\TestFileLocator;

class MysqlCliDumpRestorerTest extends \PHPUnit\Framework\TestCase
{
    const DB_PREFIX = 'test_rdig_next_';
    /**
     * @var string
     */
    private static $dbBaseUrl;

    /**
     * @var string
     */
    private static $dbName;

    public static function setUpBeforeClass()
    {
        $dbUrl = $_ENV['DATABASE_URL'];
        self::$dbBaseUrl = preg_replace('/([^\/])+$/', '', $dbUrl, 1);
    }

    public static function tearDownAfterClass()
    {
        self::dropDatabase();
    }

    public function setUp()
    {
        $this::dropDatabase();
        $this::$dbName = $this->generateDatabaseName();
        $this::createDatabase();
    }

    public function testExecute()
    {
        $dump = TestFileLocator::classToTestDataPath(
            MysqlCliDumpRestorer::class,
            'dump.sql'
        );
        $executor = self::getExecutor(self::getDbUrl());
        $restorer = new MysqlCliDumpRestorer($executor);
        $restorer->execute($dump);
        $sql = 'SHOW TABLES;';
        $output = $executor->execute(['-e' => $sql, '-s' => null, '-r' => null]);
        $this->assertCount(1, $output);
        $this->assertEquals('test_table', $output[0]);
    }

    private function generateDatabaseName(): string
    {
        return $this::DB_PREFIX.substr(md5(rand()), 0, 8);
    }

    private static function getDbUrl(): string
    {
        return self::$dbBaseUrl.self::$dbName;
    }

    private static function dropDatabase()
    {
        if (!self::$dbName) {
            return;
        }
        $sql = 'DROP DATABASE IF EXISTS '.self::$dbName;
        self::getExecutor(self::$dbBaseUrl)->execute(['-e' => $sql]);
    }

    private static function createDatabase()
    {
        if (!self::$dbName) {
            return;
        }
        $sql = 'CREATE DATABASE '.self::$dbName;
        self::getExecutor(self::$dbBaseUrl)->execute(['-e' => $sql]);
    }

    private static function getExecutor(string $dbUrl): MysqlCliExecutor
    {
        return new MysqlCliExecutor($dbUrl);
    }
}
