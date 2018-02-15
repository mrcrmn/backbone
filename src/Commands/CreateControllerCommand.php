<?php

namespace mrcrmn\Backbone\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateControllerCommand extends Command
{

    private $controllerString = '<?php

namespace App\Http;

use Symfony\Component\HttpFoundation\Request;

class %s extends Controller
{
    public function example(Request $request)
    {
        //
    }   
}
    ';

    public function configure()
    {
        $this
            ->setName('make:controller')
            ->setDescription('Creates a Controller.')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the Controller.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $controllerString = sprintf($this->controllerString, $name);

        file_put_contents(__DIR__ . '/../../app/Http/' . $name . '.php', $controllerString);
        $output->writeln("Successfully created $name.php");
    }
}