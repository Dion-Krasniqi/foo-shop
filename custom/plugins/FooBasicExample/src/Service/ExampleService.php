<?php declare(strict_types=1);

namespace Foo\Service;

use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Core\System\SystemConfig\SystemConfigService;
class ExampleService
{
    public function __construct(private SystemConfigService $systemConfigService)
    {
    }
    public function getShopname(SalesChannelContext $salesChannelContext): string
    {
        return $this->systemConfigService->getString('core.basicInformation.shopName',
            $salesChannelContext->getSalesChannel()->getId());
    }
}