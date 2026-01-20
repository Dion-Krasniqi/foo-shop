<?php declare(strict_types=1);

namespace Foo\Command;

use Shopware\Core\Content\Product\ProductEntity;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Kernel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;


#[AsCommand(name: 'foo-commands:example')]
class ExampleCommand extends Command
{
    private $kernel;
    /** @var EntityRepository  */
    private $productRepository;

    public function __construct(Kernel $kernel, EntityRepository $productRepository, string $name = null)
    {
        parent::__construct($name);
        $this->kernel = $kernel;
        $this->productRepository = $productRepository;
    }

    protected function configure(): void
    {
        $this->setDescription('This is printed in terminal');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {   $criteria = new Criteria();
        $output->writeln($this->kernel->getProjectDir());
        $context = Context::createDefaultContext();
        $searchResults = $this->productRepository->search($criteria, $context);
        foreach($searchResults->getEntities() as $product){
            /** @var ProductEntity $product*/
            $output->writeln($product->getId());
        }
        return Command::SUCCESS;
    }

}