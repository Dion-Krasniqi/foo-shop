<?php declare(strict_types=1);

namespace Foo\Core\Checkout\Cart;

use Shopware\Core\Checkout\Cart\Cart;
use Shopware\Core\Checkout\Cart\CartBehavior;
use Shopware\Core\Checkout\Cart\CartProcessorInterface;
use Shopware\Core\Checkout\Cart\LineItem\CartDataCollection;
use Shopware\Core\Checkout\Cart\LineItem\LineItem;
use Shopware\Core\Checkout\Cart\LineItem\LineItemCollection;
use Shopware\Core\Checkout\Cart\Price\PercentagePriceCalculator;
use Shopware\Core\Checkout\Cart\Price\Struct\PercentagePriceDefinition;
use Shopware\Core\Checkout\Cart\Rule\LineItemRule;
use Shopware\Core\System\SalesChannel\SalesChannelContext;

class DiscountCollector implements CartProcessorInterface
{
    private PercentagePriceCalculator $calculator;

    public function __construct(PercentagePriceCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function process(CartDataCollection $data, Cart $original, Cart $toCalculate, SalesChannelContext $context, CartBehavior $behavior): void
    {
        $products = $this->findFooProducts($toCalculate);
        if ($products->count() == 0){
            return;
        }

        $discountLineItem = $this->createDiscount('FOO_DISCOUNT');
        $definition = new PercentagePriceDefinition(-10,
        new LineItemRule(LineItemRule::OPERATOR_EQ, $products->getKeys()));

        $discountLineItem->setPriceDefinition($definition);
        $discountLineItem->setPrice($this->calculator->calculate($definition->getPercentage(),
        $products->getPrices(), $context));

        $toCalculate->add($discountLineItem);
    }

    private function findFooProducts(Cart $cart): LineItemCollection
    {
        return $cart->getLineItems()->filter( function (LineItem $item) {
            if ($item->getType() !== LineItem::PRODUCT_LINE_ITEM_TYPE) {
                return false;
            }
            $labeledFoo = stripos($item->getLabel(), 'Foo') !== false;

            if ($labeledFoo) {
                return false;
            }

            return $item;
        });
    }

    private function createDiscount(string $name): LineItem
    {
        $discountLineItem = new LineItem($name, 'foo_discount', null, 1);

        $discountLineItem->setLabel('Foo Discounted!');
        $discountLineItem->setGood(false);
        $discountLineItem->setStackable(false);
        $discountLineItem->setRemovable(true);
        return $discountLineItem;

    }
}