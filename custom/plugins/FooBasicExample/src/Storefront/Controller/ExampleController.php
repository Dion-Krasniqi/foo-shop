<?php declare(strict_types=1);

namespace Foo\Storefront\Controller;

use Foo\FooBasicExample;
use Shopware\Core\PlatformRequest;
use Shopware\Storefront\Framework\Routing\StorefrontRouteScope;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(defaults: [PlatformRequest::ATTRIBUTE_ROUTE_SCOPE=> [StorefrontRouteScope::ID]])]
class ExampleController extends StorefrontController
{
    #[Route(path: '/example', name:'frontend.example.example', methods: ['GET'])]
    public function showExample(): Response
    {
        return $this->renderStorefront('@FooBasicExample/storefront/page/example.html.twig',
            ['example' => 'Hello World!']);
    }

}