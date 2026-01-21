<?php declare(strict_types=1);

namespace Foo\Storefront\Controller;

use Foo\Exceptions\ExampleException;
use Foo\FooBasicExample;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\NotFilter;
use Shopware\Core\PlatformRequest;
use Shopware\Storefront\Framework\Routing\StorefrontRouteScope;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(defaults: [PlatformRequest::ATTRIBUTE_ROUTE_SCOPE=> [StorefrontRouteScope::ID]])]
class ExampleController extends StorefrontController
{
    private $productRepository;
    public function __construct(EntityRepository $productRepository)
    {
        $this->productRepository = $productRepository;

    }

    #[Route(path: '/example', name:'frontend.example.example', methods: ['GET'])]
    public function showExample(Request $request, Context $context): Response
    {
        $criteria = new Criteria();
        $criteria->setLimit(3);
        $criteria->addFilter(new NotFilter(
                                NotFilter::CONNECTION_AND, [new EqualsFilter('name','')]
        ));
        $context = Context::createDefaultContext();
        $products = $this->productRepository->search($criteria, $context);
        return $this->renderStorefront('@FooBasicExample/storefront/page/example.html.twig',
            [ 'products' => $products ]);
    }

    #[Route(path: '/unknown', name:'frontend.unknwon.example', methods: ['GET'])]
    public function showError(Request $request, Context $context): Response
    {
        throw new ExampleException('Something went wrong!');
    }



}