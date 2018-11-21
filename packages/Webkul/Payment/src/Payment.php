<?php

namespace Webkul\Payment;

use Illuminate\Support\Facades\Config;

class Payment
{
<<<<<<< HEAD
=======

>>>>>>> 1c274447057da2b16e13a1b849e727667069c5aa
    /**
     * Returns all supported payment methods
     *
     * @return array
     */
    public function getSupportedPaymentMethods()
    {
        $paymentMethods = [];

        foreach (Config::get('paymentmethods') as $paymentMethod) {
<<<<<<< HEAD
                $object = new $paymentMethod['class'];

                if($object->isAvailable()) {
                    $paymentMethods[] = [
                        'method' => $object->getCode(),
                        'method_title' => $object->getTitle(),
                        'description' => $object->getDescription(),
                    ];
                }
=======
            $object = app($paymentMethod['class']);

            if($object->isAvailable()) {
                $paymentMethods[] = [
                    'method' => $object->getCode(),
                    'method_title' => $object->getTitle(),
                    'description' => $object->getDescription(),
                ];
            }
>>>>>>> 1c274447057da2b16e13a1b849e727667069c5aa
        }

        return [
                'jump_to_section' => 'payment',
                'html' => view('shop::checkout.onepage.payment', compact('paymentMethods'))->render()
            ];
    }
<<<<<<< HEAD
=======

    /**
     * Returns payment redirect url if have any
     *
     * @return array
     */
    public function getRedirectUrl($cart)
    {
        $payment = app(Config::get('paymentmethods.' . $cart->payment->method . '.class'));

        return $payment->getRedirectUrl();
    }
>>>>>>> 1c274447057da2b16e13a1b849e727667069c5aa
}