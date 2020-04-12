<?php

namespace App\Command;

use App\Service\Helper\MysqlCli\MysqlDumpCliExecutor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DumpTestDatabaseSchemaCommand extends Command
{
    /**
     * @var string
     */
    private $projectDir;

    /**
     * @var MysqlDumpCliExecutor
     */
    private $dumper;

    protected static $defaultName = 'app:test:dump-db-schema';

    public function __construct(MysqlDumpCliExecutor $dumper, string $projectDir)
    {
        $this->projectDir = $projectDir;
        $this->dumper = $dumper;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Dump the test database schema')
            ->addOption('destination', 'd', InputOption::VALUE_REQUIRED, 'The dump file destination directory. Relative paths are intended to be in app project dir', 'tests/data/Functional/Migrations')
            ->addArgument('filename', InputArgument::OPTIONAL, 'The dump file name without extension', 'latest')
            ->setHelp(
                'This command allows you to set up the test database dropping the old one and '.
                'restore the whole schema from a chosen dump placed in test/data/Functional/Migration folder'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $dest = $input->getOption('destination');
        if (DIRECTORY_SEPARATOR !== $dest[0]) {
            $dest = $this->projectDir.DIRECTORY_SEPARATOR.$dest;
        }
        $dumpFile = $dest.DIRECTORY_SEPARATOR.$input->getArgument('filename').'.sql';
        $output->write("<info>Dumping database schema to <comment>$dumpFile</comment>:</info>");
        $this->dumper->execute(['--no-data' => ''], $dumpFile);
        $output->writeln(' <comment>done</comment>');

        return 0;
    }

    private function dropDb(OutputInterface $output): int
    {
        $dropCommand = $this->getApplication()->find('doctrine:database:drop');
        $dropCommandInput = new ArrayInput([
            'command' => 'doctrine:database:drop',
            '--if-exists' => '1',
            '--force' => '1',
        ]);

        return $dropCommand->run($dropCommandInput, $output);
    }

    private function createDb(OutputInterface $output): int
    {
        $createCommand = $this->getApplication()->find('doctrine:database:create');
        $createCommandInput = new ArrayInput([
            'command' => 'doctrine:database:create',
        ]);

        return $createCommand->run($createCommandInput, $output);
    }
}
