<?php

namespace Backbone\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCommandCommand extends Command
{

    public function configure()
    {
        $this
            ->setName('make:command')
            ->setDescription('Creates a Command.')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the Command.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');

        $filePath = __DIR__ . '/../../app/Commands/' . $name . '.php';

        if (! file_exists($filePath)) {

            $string = file_get_contents(__DIR__ . '/../resources/templates/Command.txt');
            $controllerString = sprintf($string, $name);

            file_put_contents($filePath, $controllerString);
            
            $output->writeln("Successfully created $name.php");
        } else {
            $output->writeln("$name.php already exists");
        }
    }
}