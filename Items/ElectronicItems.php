<?php

namespace ElectronicSale;

final class ElectronicItems
{
    /**
     * @param ElectronicItem[] $items
     */
    public function __construct(private array $items){}

    /**
     * @return ElectronicItem[]
     */
    public function getSortedItemsByPrice(): array
    {
        $toSort = $this->items;

        usort(
            $toSort,
            static fn(ElectronicItem $item1, ElectronicItem $item2) => $item1->getPrice() <=> $item2->getPrice()
        );
        return $toSort;
    }

    /**
     * @return ElectronicItem[]
     */
    public function getSortedItemsByTotalPrice(): array
    {
        $toSort = $this->items;

        usort(
            $toSort,
            static fn(ElectronicItem $item1, ElectronicItem $item2) => $item1->getTotalPriceWithExtras() <=> $item2->getTotalPriceWithExtras()
        );
        return $toSort;
    } 

    /**
     * @param Type $type
     * @return ElectronicItem[]
     */
    public function getItemsByType($type): array
    {
        $types = ['console', 'television', 'controller', 'microwave'];
        if(in_array($type, $types)){
            return array_values(
                array_filter($this->items, function($item) use ($type){
                    return $item->getType() == $type;
                })
            );
        }
    }

    public function getTotalPrice(): float
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item->getTotalPriceWithExtras();
        }

        return $total;
    }
}