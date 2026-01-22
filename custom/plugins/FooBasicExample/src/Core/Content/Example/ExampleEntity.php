<?php declare(strict_types=1);

namespace Foo\Core\Content\Example;

use Shopware\Core\Framework\DataAbstractionLayer\Attribute\Field;
use Shopware\Core\Framework\DataAbstractionLayer\Attribute\FieldType;
use Shopware\Core\Framework\DataAbstractionLayer\Attribute\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Attribute\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityCustomFieldsTrait;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;


class ExampleEntity extends Entity
{
    use EntityIdTrait;
    protected string $name;


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name):void
    {
        $this->name = $name;
    }
}