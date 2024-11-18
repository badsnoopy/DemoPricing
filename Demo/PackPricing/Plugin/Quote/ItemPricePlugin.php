<?php
namespace Demo\PackPricing\Plugin\Quote;

use Magento\Quote\Model\Quote\Item;
use Demo\PackPricing\Model\PricingCalculator;

class ItemPricePlugin
{
    protected $pricingCalculator;

    public function __construct(PricingCalculator $pricingCalculator)
    {
        $this->pricingCalculator = $pricingCalculator;
    }

    public function beforeSetCustomPrice(Item $item)
    {
        $quantity = $item->getQty();
        $totalPrice = $this->pricingCalculator->calculateTotalPrice($quantity);
        $unitPrice = $totalPrice / $quantity;

        $item->setCustomPrice($unitPrice);
        $item->setOriginalCustomPrice($unitPrice);
        $item->getProduct()->setIsSuperMode(true);
    }
}
