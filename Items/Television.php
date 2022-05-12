<?php

namespace ElectronicSale;

final class Television implements ElectronicItem
{
    /**
     * @var ElectronicItem[]
     */
    private $extras = [];

    public function __construct(private float $price, private int $quantity){}

    public function maxExtras(): float
    {
        return INF;
    }

    public function getType()
    {
        return 'television';
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function addExtra(ElectronicItem $item): void
    {
        $this->extras[] = $item;
    }

    public function getExtras(): array
    {
        return $this->extras;
    }

    public function getTotalPriceWithExtras(): float
    {
        $total = $this->price * $this->quantity;

        foreach ($this->extras as $extra) {
            $total += $extra->getPrice() * $this->quantity;
        }

        return $total;
    }
}
