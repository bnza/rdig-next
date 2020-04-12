<?php


namespace App\Service\Helper\MysqlCli;


class MysqlDumpCliExecutor extends AbstractMysqlCliExecutor
{

    public function getCommandName(): string
    {
        return 'mysqldump';
    }
}
