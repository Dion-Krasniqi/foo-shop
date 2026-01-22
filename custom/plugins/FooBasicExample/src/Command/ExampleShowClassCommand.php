<?php declare(strict_types=1);

namespace Foo\Command;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use \Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'foo-commands:show-class')]
class ExampleShowClassCommand extends Command
{
    /** @var EntityRepository   */
    private EntityRepository $exampleRepository;

    public function __construct(EntityRepository $exampleRepository, string $name = null)
    {
        parent::__construct($name);

        $this->exampleRepository = $exampleRepository;
    }

    protected function configure(): void
    {
        $this->setDescription('Show class');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(get_class($this->exampleRepository));
        return COMMAND::SUCCESS;
    }
}