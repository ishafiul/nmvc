<?php
namespace Console\commands;
use Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateModel extends Command
{

    public function configure()
    {
        $this
            -> setName('generate:model')
            -> setDescription('Create a new model')
            -> setHelp('This command allows you to Create a new model')
            -> addArgument('modelName', InputArgument::REQUIRED, 'Model name');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        //$this -> greetUser($input, $output);
        return is_int($this -> createModel($input, $output)) ? $this -> createModel($input, $output) : 0;
    }
}