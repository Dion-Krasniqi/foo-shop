<?php declare(strict_types=1);

namespace Foo\Storefront\Route\Response;

use Foo\Core\Content\Example\ExampleEntity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\Struct\Struct;
use Shopware\Core\System\SalesChannel\StoreApiResponse;

class ExampleEntityResponse extends StoreApiResponse
{
    /** @var ExampleEntity */
    protected $entity;
    public function __construct(EntityRepository $entity)
    {
        $this->entity = $entity;
    }

    public function getExample(): ExampleEntity
    {
        return $this->entity;
    }
}
