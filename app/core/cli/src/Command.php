<?php
namespace Console;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Console\functions\Controller;
/**
 * Author: Chidume Nnamdi <kurtwanger40@gmail.com>
 */
class Command extends SymfonyCommand
{

    private Controller $controller;

    public function __construct()
    {
        parent::__construct();
        $this->controller = new Controller();
    }

    protected function generateController(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output -> writeln('<fg=green>====**** Creating Controller ****====</>');

        // outputs a message without adding a "\n" at the end of the line
        $output -> write($this->controller->generate($input -> getArgument('controllerName')));
    }
}