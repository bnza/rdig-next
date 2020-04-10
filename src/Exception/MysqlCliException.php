<?php


namespace App\Exception;


use Throwable;

class MysqlCliException extends \RuntimeException
{
    /**
     * @var array
     */
    private $output = [];

    /**
     * @var string
     */
    private $command;

    public function __construct($command, $output, $code = 1, Throwable $previous = null)
    {
        parent::__construct('mysql cli command failed', $code, $previous);
    }

    /**
     * @return array
     */
    public function getOutput(): array
    {
        return $this->output;
    }

    /**
     * @return string
     */
    public function getCommand(): string
    {
        return $this->command;
    }


}
