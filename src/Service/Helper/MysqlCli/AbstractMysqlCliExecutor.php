<?php

namespace App\Service\Helper\MysqlCli;

use App\Exception\MysqlCliException;

abstract class AbstractMysqlCliExecutor
{
    const DEFAULT_EXTRA_FILE = '--defaults-extra-file';
    /**
     * @var string
     */
    protected $databaseUrl;

    /**
     * @var MysqlCnfFileGenerator
     */
    private $cnfGenerator;

    abstract public function getCommandName(): string;

    public function __construct(string $databaseUrl)
    {
        $this->databaseUrl = $databaseUrl;
    }

    final public function execute(array $options, ?string $outputFilePath = '', ?string $inputFilePath = ''): array
    {
        $command = $this->getCommand($options);
        if ($inputFilePath) {
            if (!file_exists($inputFilePath)) {
                throw new \RuntimeException('No such file: '.dirname($inputFilePath));
            }
            $command .= "<$inputFilePath";
        }
        if ($outputFilePath) {
            if (!file_exists(dirname($outputFilePath))) {
                throw new \RuntimeException('Directory does not exist: '.dirname($outputFilePath));
            }
            $command .= ">$outputFilePath";
        }
        $output = [];
        $return = 0;
        exec($command, $output, $return);
        if (0 !== $return) {
            throw new MysqlCliException($command, $output, $return);
        }
        $this->cnfGenerator->delete();

        return $output;
    }

    protected function getCommand(array $options): string
    {
        $commandOptions = '';

        if (array_key_exists(self::DEFAULT_EXTRA_FILE, $options)) {
            $commandOptions .= ' '.self::DEFAULT_EXTRA_FILE.'='.$options[self::DEFAULT_EXTRA_FILE];
            unset($options[self::DEFAULT_EXTRA_FILE]);
        } else {
            $this->cnfGenerator = new MysqlCnfFileGenerator($this->databaseUrl);
            $commandOptions .= ' '.self::DEFAULT_EXTRA_FILE.'='.$this->cnfGenerator->generate();
        }

        foreach ($options as $flag => $value) {
            $commandOptions .= " $flag";
            if ($value) {
                $commandOptions .= escapeshellarg($value);
            }
        }

        return $this->getCommandName()
            .' '
            .$commandOptions
            .' '
            .ltrim(parse_url($this->databaseUrl, PHP_URL_PATH), '/');
    }
}
