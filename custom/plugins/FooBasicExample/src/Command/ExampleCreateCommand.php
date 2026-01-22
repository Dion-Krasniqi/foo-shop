<?php declare(strict_types=1);

namespace Foo\Command;


use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\Uuid\Uuid;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name:'foo-commands:create-example')]
class ExampleCreateCommand extends Command
{
    /** @var EntityRepository */
    private $exampleRepository;
    public function __construct(EntityRepository $exampleRepository, string $name = null){
        parent::__construct($name);
        $this->exampleRepository = $exampleRepository;
    }

    protected function configure()
    {
        $this->setDescription('Create a new example entity entry')
            ->addArgument('name', InputArgument::REQUIRED, 'Example name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $id = Uuid::randomHex();
        $name = $input->getArgument('name');
        $this->exampleRepository->create([[
            'id' => $id,
            'name' => $name
        ]], Context::createDefaultContext());
        return Command::SUCCESS;
    }
}