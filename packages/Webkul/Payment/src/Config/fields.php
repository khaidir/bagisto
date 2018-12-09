<?php

return [
    'paymentmethods' => [

        'paypal_standard' => [
            [
                'name' => 'title',
                'title' => 'Title',
                'type' => 'text',
                'validation' => 'required',
                'channel_based' => false,
                'locale_based' => true
            ], [
                'name' => 'description',
                'title' => 'Description',
                'type' => 'textarea',
                'channel_based' => false,
                'locale_based' => true
            ],  [
                'name' => 'order_status',
                'title' => 'Order Status',
                'type' => 'select',
                'options' => [
                    [
                        'title' => 'Pending',
                        'value' => 'pending'
                    ], [
                        'title' => 'Approved',
                        'value' => 'Approved'
                    ], [
                        'title' => 'Pending Payment',
                        'value' => 'pending_payment'
                    ]
                ],
                'validation' => 'required'
            ], [
                'name' => 'active',
                'title' => 'Status',
                'type' => 'select',
                'options' => [
                    [
                        'title' => 'Active',
                        'value' => true
                    ], [
                        'title' => 'Inactive',
                        'value' => false
                    ]
                ],
                'validation' => 'required'
            ], [
                'name' => 'business_account',
                'title' => 'Business Account',
                'type' => 'select',
                'type' => 'text',
                'validation' => 'required'
            ]
        ]
    ]
];