<?php declare(strict_types=1);

namespace Foo\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;


#[AsCommand(name: 'foo-commands:example')]
class ExampleCommand extends Command
{
    protected function configure(): void
    {
        $this->setDescription('This is printed in terminal');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Functionality');
        return Command::SUCCESS;
    }

}