<?php

namespace Omnipay\RocketGate;

use Omnipay\Common\AbstractGateway;

/**
 * RocketGate Gateway
 *
 * RocketGate is an industry leader in transaction processing.
 * RocketGate's secure, fault-tolerant and reliable payment processing platform includes a suite of
 * sophisticated features including chargeback processing, risk management,
 * advanced processing and merchant support tools. RocketGate's platform is engineered to be fast,
 * customizable and profitable for our business partners.
 *
 * ### Example
 * <code>
 * // Initialize the gateway
 * $gateway = Omnipay::create('RocketGate');
 * $gateway->initialize(array(
 *     'merchantId'       => 'XXXXXXXXXXXX',
 *     'merchantPassword' => 'XXXXXXXXXXXX',
 *     'testMode'         => true,
 * ));
 *
 * // Create a credit card object
 * $card = new CreditCard(array(
 *     'firstName'       => 'Example',
 *     'lastName'        => 'Customer',
 *     'number'          => '4242424242424242',
 *     'expiryMonth'     => '01',
 *     'expiryYear'      => '2032',
 *     'cvv'             => '123',
 *     'email'           => 'customer@example.com',
 *     'billingAddress1' => 'Mary',
 *     'billingCountry'  => 'SG',
 *     'billingCity'     => 'Singapore',
 *     'billingPostcode' => '567278',
 *     'billingState'    => 'Singapore',
 * ));
 *
 * // Do a purchase transaction on the gateway
 * $transaction = $gateway->purchase(array(
 *     'amount'      => '50.00',
 *     'currency'    => 'USD',
 *     'card'        => $card,
 *      'transactorId'  => random_int(0, 1000000000),
 *      'transactionId' => random_int(0, 1000000000),
 * ));
 *
 * $response = $transaction->send();
 * if ($response->isSuccessful()) {
 *     echo "Purchase transaction was successful!\n";
 *     $sale_id = $response->getTransactionReference();
 *     echo "Transaction reference = " . $sale_id . "\n";
 * }
 * </code>
 *
 * @date      2019-08-02
 * @author    markbonnievestil (mbvestil@gmail.com)
 */
class Gateway extends AbstractGateway
{
    /**
     * Get the gateway name
     *
     * @return string
     */
    public function getName()
    {
        return 'RocketGate';
    }

    /**
     * @return string
     */
    public function getMerchantId()
    {
        return $this->getParameter('merchantID');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setMerchantId($value)
    {
        return $this->setParameter('merchantID', $value);
    }

    /**
     * @return string
     */
    public function getMerchantPassword()
    {
        return $this->getParameter('merchantPassword');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setMerchantPassword($value)
    {
        return $this->setParameter('merchantPassword', $value);
    }

    /**
     * Get default parameters
     *
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'merchantId'       => '',
            'merchantPassword' => '',
            'testMode'         => false,
        );
    }

    /**
     * Create a purchase request.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\RocketGate\Message\PurchaseRequest', $parameters);
    }
}