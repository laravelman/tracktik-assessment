<?php

namespace ElectronicSale;

include('./Items/ElectronicItem.php');

final class Console implements ElectronicItem
{
    private const MAX_EXTRAS = 4;

    /**
     * @var ElectronicItem[]
     */
    private $extras = [];

    public function __construct(private float $price, private int $quantity){}

    public function maxExtras(): float
    {
        return self::MAX_EXTRAS;
    }

    public function getType()
    {
        return 'console';
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getExtras(): array
    {
        return $this->extras;
    }

    public function addExtra(ElectronicItem $item): void
    {
        if (count($this->extras) >= self::MAX_EXTRAS) {
            throw new \Exception("No more extras allowed for the selected item.");
        }

        $this->extras[] = $item;
    }

    public function getTotalPriceWithExtras(): float
    {
        $total = $this->price  * $this->quantity;

        foreach ($this->extras as $extra) {
            $total += $extra->getPrice();
        }

        return $total;
    }
}
