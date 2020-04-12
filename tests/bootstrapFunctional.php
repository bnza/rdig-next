<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/tests/bootstrap.php';

function bootstrap(): void
{
    $kernel = new \App\Kernel('test', true);
    $kernel->boot();

    $application = new \Symfony\Bundle\FrameworkBundle\Console\Application($kernel);
    $application->setAutoExit(false);

    $application->run(new \Symfony\Component\Console\Input\ArrayInput([
        'command' => 'app:test:setup-db',
    ]));

    $kernel->shutdown();
}

bootstrap();
