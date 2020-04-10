<?php


namespace App\Command;

use \RuntimeException;
use App\Service\Helper\MysqlCli\MysqlCliDumpRestorer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class SetupTestDatabaseCommand extends Command
{
    /**
     * @var string
     */
    private $projectDir;

    /**
     * @var MysqlCliDumpRestorer
     */
    private $restorer;

    protected static $defaultName = 'app:test:setup-db';

    public function __construct(MysqlCliDumpRestorer $restorer, string $projectDir)
    {
        $this->projectDir = $projectDir;
        $this->restorer = $restorer;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Set up the test database')
            ->addArgument('dump', InputArgument::OPTIONAL, 'The dump file name without extension', 'latest')
            ->setHelp(
                'This command allows you to set up the test database dropping the old one and ' .
                'restore the whole schema from a chosen dump placed in test/data/Functional/Migration folder'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($_ENV['APP_ENV'] !== 'test') {
            throw new RuntimeException('This command should be only run in "test" environment');
        }

        $this->dropDb($output);
        $this->createDb($output);

        $output->write('<info>Dumping database schema:</info>');
        $dumpFile = $this->projectDir.'/tests/data/Functional/Migrations/'.$input->getArgument('dump').'.sql';
        $this->restorer->execute($dumpFile);
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
            'command' => 'doctrine:database:create'
        ]);

        return $createCommand->run($createCommandInput, $output);
    }


}
