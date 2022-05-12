<?php

//Had to include and use - some issue with directory - please ignore this
use ElectronicSale\Console;
use ElectronicSale\Controller;
use ElectronicSale\ElectronicItems;
use ElectronicSale\Microwave;
use ElectronicSale\Television;

include('./Items/ElectronicItems.php');
include('./Items/Console.php');
include('./Items/Television.php');
include('./Items/Microwave.php');
include('./Items/Controller.php');

// Console
$console = new Console(190.99, 1);

// Remote Controllers
$remoteController = new Controller(59.99, 1);
$wiredController = new Controller(89.99, 1);

// Adding Console Extras
$console->addExtra($remoteController);
$console->addExtra($remoteController);
$console->addExtra($wiredController);
$console->addExtra($wiredController);


// Televisions
$televisionOne = new Television(200.99, 1);
$televisionTwo = new Television(300.99, 1);


// Adding Television Extras
$televisionOne->addExtra($remoteController);
$televisionOne->addExtra($remoteController);
$televisionTwo->addExtra($remoteController);

// Microwave
$microwave = new Microwave(100.99, 1);

// Order Creation
$order = new ElectronicItems([$console, $televisionOne, $televisionTwo, $microwave]);

// Get sorted items for display
$sortedItems = $order->getSortedItemsByTotalPrice();

//How much console and controllers cost?
$orderDetails = new ElectronicItems([$console]);

?>

<!-- Used HTML & Bootstrap To Demonstrate Properly -->
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="row container p-4 m-4">
        <div class="col-md-5 col-lg-4 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Your cart</span>
            </h4>
            <ul class="list-group mb-3">
                <?php
                foreach ($sortedItems as $item) {
                ?>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0 text-capitalize"><?php echo $item->getType() . ' - ' . $item->getPrice(); ?></h6>
                            <?php if (sizeof($item->getExtras()) > 0) {
                                foreach ($item->getExtras() as $extra) {
                            ?>
                                    <small class="text-muted text-capitalize"><?php echo $extra->getType() . ' - ' . $extra->getPrice(); ?></small><br>
                            <?php
                                }
                            } ?>
                        </div>
                        <span class="text-muted">$<?php echo $item->getTotalPriceWithExtras(); ?></span>
                    </li>
                <?php
                }
                ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>$<?php echo $order->getTotalPrice(); ?></strong>
                </li>
            </ul>
            <small>Note: Total Console & Controller Sum is: $<?php echo $orderDetails->getTotalPrice(); ?></small>
        </div>
    </div>
</body>

</html>