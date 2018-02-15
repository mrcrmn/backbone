<?php

namespace mrcrmn\Backbone\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ServeCommand extends Command
{

    public function configure()
    {
        $this
            ->setName('serve')
            ->setDescription('serves the Application');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Local Development Server startet on localhost:8000");

        shell_exec("php -S localhost:8000 -t public");
    }
}