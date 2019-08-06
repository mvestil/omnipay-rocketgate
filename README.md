# omnipay-rocketgate
Omnipay driver for RocketGate Gateway

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements PaymentWall support for Omnipay.

[RocketGate](https://www.rocketgate.com/) is an industry leader in transaction processing. 
RocketGate's secure, fault-tolerant and reliable payment processing platform includes a suite of
 sophisticated features including chargeback processing, risk management, advanced processing 
 and merchant support tools. RocketGate's platform is engineered to be fast, customizable and profitable for our business partners.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "mvestil/omnipay-rocketgate": "~1.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following transactions are provided by this package via the REST API:

* Card Payment
* Token Payment
* Refund
* Void
* 3DSecure

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.  There are also examples in the class API documentation.

## Test modes

You must pass testMode=true to this package in order to make test payments

## Authentication

To call RocketGate Payments API, merchant id and merchant password is required and will be passed
via RocketGate's PHP SDK. You can get these values from RocketGate itself can be seen in their admin portal.

## Usage

```
// Initialize the gateway
$gateway = Omnipay::create('RocketGate');
$gateway->initialize(array(
  'merchantID'       => 'XXXXXXXXXXXX',
  'merchantPassword' => 'XXXXXXXXXXXX',
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
$transactorId = random_int(0, 1000000000)
$transaction = $gateway->purchase(array(
  'amount'        => '50.00',
  'currency'      => 'USD',
  'card'          => $card,
  'transactorId'  => $transactorId,
  'transactionId' => random_int(0, 1000000000),
));

$response = $transaction->send();
if ($response->isSuccessful()) {
  echo "Purchase transaction was successful!\n";
  $token = $response->getCardReference();
  echo "Card reference = " . $token . "\n";
}

// Do a token transaction on the gateway
$transaction = $gateway->purchase(array(
    'amount'        => '50.0',
    'currency'      => 'USD',
    'transactorId'  => $transactorId,
    'transactionId' => random_int(0, 1000000000),
    'cardReference' => $response->getCardReference(),
));
```

## Unit Testing

Tests are not yet included

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.
