<?php

namespace App\Service\Helper\MysqlCli;

class MysqlCliDumpRestorer
{
    /**
     * @var MysqlCliConnectionParametersFormatter
     */
    private $executor;

    public function __construct(MysqlCliExecutor $executor)
    {
        $this->executor = $executor;
    }

    public function execute(string $dumpPath): array
    {
        return $this->executor->execute([], null, $dumpPath);
    }
}
