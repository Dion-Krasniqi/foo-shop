<?php declare(strict_types=1);

namespace Foo\Exceptions;

use Shopware\Core\Framework\ShopwareHttpException;
use Symfony\Component\HttpFoundation\Response;

class ExampleException extends ShopwareHttpException
{
    public function getStatusCodee(): int
    {
        return Response::HTTP_NOT_FOUND;
    }

    public function getErrorCode(): string
    {
        return 'EXAMPLE_NOT_FOUND';
    }
}