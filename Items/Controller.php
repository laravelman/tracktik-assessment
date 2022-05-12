<?php

namespace ElectronicSale;

final class Controller implements ElectronicItem
{
    private const MAX_EXTRAS = 0;

    public function __construct(private float $price, private int $quantity){}

    public function maxExtras(): float
    {
        return self::MAX_EXTRAS;
    }

    public function getType()
    {
        return 'controller';
    }

    public function getPrice(): float
    {
        return $this->price;
    }


    public function addExtra(ElectronicItem $item): void
    {
        throw new \Exception("No extras allowed for the selected item.");
    }

    public function getTotalPriceWithExtras(): float
    {
        return $this->price * $this->quantity;
    }
}
