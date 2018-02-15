<?php

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ServeCommand extends Command
{

    public function configure()
    {
        $this
            ->setName('name')
            ->setDescription('description');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        
    }
}