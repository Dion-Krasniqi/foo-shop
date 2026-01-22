<?php declare(strict_types=1);

namespace Foo\Command;


use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name:'foo-command:list-example_entity')]
class ExampleListCommand extends Command
{
    private $exampleRepository;
    public function __construct(EntityRepository $exampleRepository, string $name = null)
    {
        parent::__construct($name);
        $this->exampleRepository = $exampleRepository;
    }

    protected function configure(): void
    {
        $this->setDescription('List example entities');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $searchResult = $this->exampleRepository->search(new Criteria(), Context::createDefaultContext());
        $table = new Table($output);
        $table->setHeaders(['uuid', 'name']);
        foreach ($searchResult->getEntities() as $example) {
            $table->addRow([
                $example->getId(),
                $example->getName(),
            ]);
        }
        $table->render();
        return Command::SUCCESS;

    }
}
