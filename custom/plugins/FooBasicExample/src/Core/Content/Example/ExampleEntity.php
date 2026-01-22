<?php declare(strict_types=1);

namespace Foo\Core\Content\Example;

use Shopware\Core\Framework\DataAbstractionLayer\Attribute\Field;
use Shopware\Core\Framework\DataAbstractionLayer\Attribute\FieldType;
use Shopware\Core\Framework\DataAbstractionLayer\Attribute\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Attribute\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\Attribute\Entity as EntityAttribute;
use Shopware\Core\Framework\DataAbstractionLayer\EntityCustomFieldsTrait;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;


#[EntityAttribute('example', since: '6.7.0.0', collectionClass: ExampleCollection::class)]
class ExampleEntity extends Entity
{
    use EntityCustomFieldsTrait;
    #[PrimaryKey]
    #[Required]
    #[Field(type: FieldType::UUID)]
    public string $id;

    #[Field(type: FieldType::STRING)]
    #[Required]
    protected string $name;

    #[Field(type: FieldType::DATETIME)]
    public ?\DateTimeInterface $createdAt;

    #[Field(type: FieldType::DATE)]
    public ?\DateTimeInterface $updatedAt = null;


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name):void
    {
        $this->name = $name;
    }
}