<?php

namespace ElectronicSale;

interface ElectronicItem
{
    public function maxExtras(): float;

    public function getPrice(): float;

    /**
     * @param ElectronicItem $item
     * @throws ElectronicItemException
     */
    public function addExtra(ElectronicItem $item): void;

    public function getTotalPriceWithExtras(): float;
}