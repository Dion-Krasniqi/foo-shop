<?php

namespace Foo\Command;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Pricing\PriceCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name:'foo-commands:push-price')]
class ExamplePushStockCommand extends Command
{
    /** @var EntityRepository */
    private $prouctRepo;

    private SystemConfigService $systemConfigService;
    public function __construct(EntityRepository $productRepo, SystemConfigService $systemConfigService,
                                string $name = null)
    {
        parent::__construct($name);
        $this->prouctRepo = $productRepo;
        $this->systemConfigService = $systemConfigService;
    }
    public function configure(): void
    {
        $this->setDescription('Apply the stock set up in the plugins configuration to all products');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $stockApproval = $this->systemConfigService->get('FooBasicExample.config.applyStock', null);
        if (!$stockApproval) {
            return Command::SUCCESS;
        }
        $stockConfig = $this->systemConfigService->get('FooBasicExample.config.stock', null);
        if (is_string($stockConfig)){
            $output->writeln($stockConfig);
            $searchResults = $this->prouctRepo->search(new Criteria(), Context::createDefaultContext());
            foreach ($searchResults->getElements() as $prod){
                $prod->setStock((int)$stockConfig);
                $output->writeln($prod->getStock());
            }
            return Command::SUCCESS;
        }
        if(is_int($stockConfig)){
            $output->writeln($stockConfig);
            $searchResults = $this->prouctRepo->search(new Criteria(), Context::createDefaultContext());
            foreach ($searchResults->getElements() as $prod){
                $prod->setStock($stockConfig);
                $output->writeln($prod->getStock());
            }
            return Command::SUCCESS;

        }

        return Command::FAILURE;
    }

}