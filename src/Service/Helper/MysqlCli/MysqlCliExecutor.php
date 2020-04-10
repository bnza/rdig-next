<?php


namespace App\Service\Helper\MysqlCli;


class MysqlCliExecutor extends AbstractMysqlCliExecutor
{

    public function getCommandName(): string
    {
        return 'mysql';
    }
}
