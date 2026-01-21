<?php declare(strict_types=1);

namespace Foo\Storefront\Route;

use Foo\Storefront\Route\Response\ExampleEntityResponse;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\PlatformRequest;
use Shopware\Core\System\SalesChannel\NoContentResponse;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Core\System\SalesChannel\StoreApiResponse;
use Shopware\Storefront\Framework\Routing\StorefrontRouteScope;
use Symfony\Component\Routing\Attribute\Route;

#[Route(defaults: [PlatformRequest::ATTRIBUTE_ROUTE_SCOPE=>StorefrontRouteScope::ID])]
class ExampleRoute
{
    /** @var EntityRepository  */
    private $exampleRepository;

    public function __construct(EntityRepository $exampleRepository)
    {
        $this->exampleRepository = $exampleRepository;
    }

    public function modify(): StoreApiResponse
    {
        return new NoContentResponse();
    }
    #[Route(path:'/store-api/example/{exampleId}', name:'store-api.example', methods: ['GET', 'POST'])]
    public function load(string $exampleId, SalesChannelContext $salesChannelContext): StoreApiResponse
    {
        if (empty($exampleId)){
            return new NoContentResponse();
        }

        $searchResults = $this->exampleRepository->search(
            new Criteria([$exampleId]),
            $salesChannelContext->getContext()
        );
        if(!$searchResults->count()){
            return new NoContentResponse();
        }
        $exampleEntity = $searchResults->first();
        return new ExampleEntityResponse($exampleEntity)
    }
}