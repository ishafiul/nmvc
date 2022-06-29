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
            ->setName('migration:create')
            ->setDescription('Create a new migration file')
            ->setHelp('This command allows you to Create a new migration file')
            ->addArgument('name', InputArgument::REQUIRED, 'Migration name');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        return is_int($this->createMigration($input, $output)) ? $this->createMigration($input, $output) : 0;
    }
}