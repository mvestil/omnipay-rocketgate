<?php

namespace Test;

require_once 'vendor/autoload.php';

use Omnipay\Common\CreditCard;
use Omnipay\Omnipay;

/**
 * Class ${NAME}
 *
 * @date      2019-08-16
 * @author    markbonnievestil
 * @copyright Copyright (c) Infostream Group
 */
class Main
{
    public $gateway;

    public function cardPayment()
    {
        // Initialize the gateway
        $this->gateway = Omnipay::create('RocketGate');
        $this->gateway->initialize(array(
            'merchantID'       => '1564174783',
            'merchantPassword' => 'GhWTV6QC78NKdsfH',
            'testMode'         => true,
        ));

// Create a credit card object
        $card = new CreditCard(array(
            'firstName'       => 'Example',
            'lastName'        => 'Customer',
            'number'          => '4242424242424242',
            'expiryMonth'     => '01',
            'expiryYear'      => '2032',
            'cvv'             => '123',
            'email'           => 'customer@example.com',
            'billingAddress1' => 'Consolacion, Cebu',
            'billingCountry'  => 'PH',
            'billingCity'     => 'Philippines',
            'billingPostcode' => '567278',
            'billingState'    => 'Philippines',
        ));

        // Do a purchase transaction on the gateway
        $transactorId = random_int(0, 1000000000);
        $transaction  = $this->gateway->purchase(array(
            'amount'        => '50.00',
            'currency'      => 'USD',
            'card'          => $card,
            'transactorId'  => $transactorId,
            'transactionId' => random_int(0, 1000000000),
        ));

        $response = $transaction->send();
        if ($response->isSuccessful()) {
            //echo "Purchase transaction was successful!\n";
            $token = $response->getCardReference();
            //echo "Card reference = " . $token . "\n";
            //echo "Transaction Reference = " . $response->getTransactionReference() . "\n";
        }

        return $response;
    }

    public function threeDSPayment()
    {
        // Initialize the gateway
        $this->gateway = Omnipay::create('RocketGate');
        $this->gateway->initialize(array(
            'merchantID'       => '1564174783',
            'merchantPassword' => 'GhWTV6QC78NKdsfH',
            'testMode'         => true,
        ));

// Create a credit card object
        $card = new CreditCard(array(
            'firstName'       => 'Example',
            'lastName'        => 'Customer',
            'number'          => '4242424242424242',
            'expiryMonth'     => '01',
            'expiryYear'      => '2032',
            'cvv'             => '123',
            'email'           => 'customer@example.com',
            'billingAddress1' => 'Consolacion, Cebu',
            'billingCountry'  => 'PH',
            'billingCity'     => 'Philippines',
            'billingPostcode' => '567278',
            'billingState'    => 'Philippines',
        ));

        // Do a purchase transaction on the gateway
        $transactorId = random_int(0, 1000000000);
        $transaction  = $this->gateway->purchase(array(
            'amount'        => '50.00',
            'currency'      => 'USD',
            'card'          => $card,
            'transactorId'  => $transactorId,
            'transactionId' => random_int(0, 1000000000),
        ));

        $response = $transaction->send();
        if ($response->isSuccessful()) {
            //echo "Purchase transaction was successful!\n";
            //$token = $response->getCardReference();
            //echo "Card reference = " . $token . "\n";
            //echo "Transaction Reference = " . $response->getTransactionReference() . "\n";
        }

        return $response;
    }

    public function refund($transactionReference, $amount)
    {
        return $response = $this->gateway->refund([
            'transactionReference' => $transactionReference,
            'amount'               => $amount
        ])->send();
    }

    public function void($transactionReference, $amount)
    {
        return $response = $this->gateway->void([
            'transactionReference' => $transactionReference,
            'amount'               => $amount
        ])->send();
    }
}

$main = new Main;
//$response = $main->cardPayment();
//echo "Token Reference = " . $response->getTransactionReference() . "\n";
//echo "Refunding " . $response->getTransactionReference() . "\n";
//$main->refund('100016C9994A485', 10.00);
//$response = $main->refund('100016C8ED8D099', 15.00);
$response = $main->threeDSPayment();

try {
//    print_r($response->getRedirectData());
//    print_r($response->isRedirect());
    print_r($response->getData());
} catch (\Exception $e) {
    echo "error : " . $e->getMessage();
}

