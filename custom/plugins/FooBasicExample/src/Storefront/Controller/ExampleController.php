<?php declare(strict_types=1);

namespace Foo\Storefront\Controller;

use Foo\Exceptions\ExampleException;
use Foo\FooBasicExample;
use Shopware\Core\Checkout\Cart\Cart;
use Shopware\Core\Checkout\Cart\LineItem\LineItem;
use Shopware\Core\Checkout\Cart\LineItemFactoryRegistry;
use Shopware\Core\Checkout\Cart\SalesChannel\CartService;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\NotFilter;
use Shopware\Core\PlatformRequest;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Framework\Routing\StorefrontRouteScope;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(defaults: [PlatformRequest::ATTRIBUTE_ROUTE_SCOPE=> [StorefrontRouteScope::ID]])]
class ExampleController extends StorefrontController
{
    private $productRepository;

    private LineItemFactoryRegistry $factory;
    private CartService $cartService;
    public function __construct(EntityRepository $productRepository, LineItemFactoryRegistry $factory, CartService $cartService)
    {
        $this->productRepository = $productRepository;
        $this->factory = $factory;
        $this->cartService = $cartService;

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

    #[Route(path: '/unknown', name:'frontend.unknown.example', methods: ['GET'])]
    public function showError(Request $request, Context $context): Response
    {
        throw new ExampleException('Something went wrong!');
    }

    #[Route(path:'/cartAdd', name:'frontend.cartExample', methods: ['GET'])]
    public function addToCart(Cart $cart, SalesChannelContext $context): Response
    {
        $lineItem = $this->factory->create([
            'type' => LineItem::PRODUCT_LINE_ITEM_TYPE,
            'referencedId' => '019bdaef26397e0488e773010e30aa69',
            'quantity' => 5,
            'payload' => ['key' => 'value']
        ], $context);
        $this->cartService->add($cart, $lineItem, $context);
        return $this->renderStorefront('@Storefront/storefront/base.html.twig');
    }




}