<?php

return [
    'cashondelivery' => [
        'code' => 'cashondelivery',
        'title' => 'Cash On Delivery',
        'description' => 'Cash On Delivery',
        'class' => 'Webkul\Payment\Payment\CashOnDelivery',
        'order_status' => 'pending',
        'active' => true
    ],

    'moneytransfer' => [
        'code' => 'moneytransfer',
        'title' => 'Money Transfer',
        'description' => 'Money Transfer',
        'class' => 'Webkul\Payment\Payment\MoneyTransfer',
        'order_status' => 'pending',
        'active' => true
<<<<<<< HEAD
=======
    ],

    'paypal_standard' => [
        'code' => 'paypal_standard',
        'title' => 'Paypal Standard',
        'description' => 'Paypal Standard',
        'class' => 'Webkul\Paypal\Payment\Standard',
        'order_status' => 'pending_payment',
        'sandbox' => true,
        'active' => true,
        'business_account' => 'test@webkul.com'
>>>>>>> 1c274447057da2b16e13a1b849e727667069c5aa
    ]
];

?>