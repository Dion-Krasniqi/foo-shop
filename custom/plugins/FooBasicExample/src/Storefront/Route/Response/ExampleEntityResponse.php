<?php declare(strict_types=1);

namespace Foo\Storefront\Route\Response;

use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\System\SalesChannel\StoreApiResponse;

class ExampleEntityResponse extends StoreApiResponse
{
    /** @var Entity */
    protected $object;

    /** @return Entity */

    public function getExample(): Entity
    {
        return $this->object;
    }
}

// Make a custom entity called ExampleEntity