<?php

namespace Backbone\Commands;

// use Backbone\Facades\File;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClearCacheCommand extends Command
{
    public function configure()
    {
        $this
            ->setName('cache:clear')
            ->setDescription('Clears the cache');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
    }
}
