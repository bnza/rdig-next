<?php


namespace App\Tests\Helper;

class TestFileLocator
{
    const TEST_MODE_FUNCTIONAL = 'functional';
    const TEST_MODE_UNIT = 'unit';

    protected static $projectRoot;

    public static function getProjectRoot(): string
    {
        if (!self::$projectRoot) {
            self::$projectRoot = self::extractRootFromPath(__DIR__);
        }
        return self::$projectRoot;
    }

    public static function classToTestDataPath(string $class, ?string $testMode = self::TEST_MODE_UNIT, ?string $dataFile = ''): string
    {
        $pieces = array_slice(explode('\\', $class), 1);
        $pieces = array_merge(['tests','data', ucfirst(strtolower($testMode))], $pieces);
        if ($dataFile) {
            array_push($pieces, $dataFile);
        }
        return self::getAbsolutePath(implode(DIRECTORY_SEPARATOR, $pieces));

    }

    public static function getAbsolutePath(string $projectRootRelativePath): string
    {
        return self::getProjectRoot() . DIRECTORY_SEPARATOR . $projectRootRelativePath;
    }

    private static function extractRootFromPath(string $path): string
    {
        $pieces = explode(DIRECTORY_SEPARATOR, $path);
        return implode(DIRECTORY_SEPARATOR, array_slice($pieces,0,-3));
    }

}
