<?php
namespace Demo\PackPricing\Model;

class PricingCalculator
{
    private $retailPrice = 5;
    private $packs = [
        20 => 80,
        10 => 45
    ];

    public function calculateTotalPrice($quantity)
    {
        $totalPrice = 0;
        $remainingQuantity = $quantity;

        krsort($this->packs);

        foreach ($this->packs as $packSize => $packPrice) {
            if ($remainingQuantity >= $packSize) {
                $packCount = intdiv($remainingQuantity, $packSize);
                $totalPrice += $packCount * $packPrice;
                $remainingQuantity %= $packSize;
            }
        }

        if ($remainingQuantity > 0) {
            $totalPrice += $remainingQuantity * $this->retailPrice;
        }

        return $totalPrice;
    }
}
