<?php


namespace App\Service\Helper\MysqlCli;

use App\Exception\MysqlCliException;

abstract class AbstractMysqlCliExecutor
{

    /**
     * @var MysqlCliConnectionParametersFormatter
     */
    protected $formatter;

    abstract public function getCommandName(): string;

    public function __construct(MysqlCliConnectionParametersFormatter $formatter)
    {
        $this->formatter = $formatter;
    }

    public function execute(array $options, ?string $outputFilePath='', ?string $inputFilePath=''): array
    {
        $command = $this->getCommand($options);
        if ($inputFilePath) {
            if (!file_exists($inputFilePath)) {
                throw new \RuntimeException('No such file: ' . dirname($inputFilePath));
            }
            $command .= "<$inputFilePath";
        }
        if ($outputFilePath) {
            if (!file_exists(dirname($outputFilePath))) {
                throw new \RuntimeException('Directory does not exist: ' . dirname($outputFilePath));
            }
            $command .= ">$outputFilePath";
        }
        $command .= ' 2>&1';
        $output = [];
        $return = 0;
        exec($command, $output, $return);
        if ($return !== 0) {
            throw new MysqlCliException($command, $output, $return);
        }
        return $output;
    }

    protected function getCommand(array $options): string
    {
        $commandOptions = '';
        foreach ($options as $flag => $value) {
            $commandOptions .= " $flag";
            if ($value) {
                $commandOptions .= escapeshellarg($value);
            }
        }
        return $this->getCommandName()
                . ' '
            . $commandOptions
                .' '
            . $this->formatter->format();
    }


}
