<?php declare(strict_types=1);

namespace Foo\Command;


use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name:'foo-commands:delete-example')]
class ExampleDeleteCommand extends Command
{
    /** @var EntityRepository */
    private $entityRepository;

    public function __construct(EntityRepository $entityRepository, $name = null)
    {
        parent::__construct($name);
        $this->entityRepository = $entityRepository;
    }
    protected function configure()
    {
        $this->setDescription('Delete an entry in the example entity table')->AddArgument('uuid',
        InputArgument::REQUIRED,'UUID of entry');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $id = $input->getArgument('uuid');
        $this->entityRepository->delete([[
            'id' => $id,
        ]], Context::createDefaultContext());
        return Command::SUCCESS;
    }
}
