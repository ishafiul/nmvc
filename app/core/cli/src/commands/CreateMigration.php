<?php
namespace Console\commands;
use Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateMigration extends Command
{

    public function configure()
    {
        $this
            -> setName('migration:create')
            -> setDescription('Greet a user based on the time of the day.')
            -> setHelp('This command allows you to greet a user based on the time of the day...')
            -> addArgument('name', InputArgument::REQUIRED, 'The username of the user.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        return is_int($this -> createMigration($input, $output)) ? $this -> createMigration($input, $output) : 0;
    }
}