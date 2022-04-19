<?php
namespace Console\commands;
use Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ApplyMigrations extends Command
{

    public function configure()
    {
        $this
            -> setName('migration:migrate')
            -> setDescription('Greet a user based on the time of the day.')
            -> setHelp('This command allows you to greet a user based on the time of the day...');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        //$this -> greetUser($input, $output);
        return is_int($this -> migrateAll($output)) ? $this -> migrateAll($output) : 0;
    }
}