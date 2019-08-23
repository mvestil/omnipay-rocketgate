<?php

use Omnipay\RocketGate\Message\PurchaseRequest;

/**
 * Class ProceedPurchase
 *
 * This is used as a second PurchaseRequest call for RocketGate for the 3DS non eligible cards.
 * RocketGate requires to have 2 Purchase calls
 * Ex.
 *      1. First purchase call responds with reasonCode in either 203, 204, 205, 223
 *      2. Merchant can then proceed with the purchase without undergoing 3ds flow by calling this class
 *
 * @date      2019-08-23
 * @author    markbonnievestil (mbvestil@gmail.com)
 */

class ProceedPurchase extends PurchaseRequest
{
    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $data = parent::getData();

        $data['USE_3D_SECURE'] = 'FALSE';

        return $data;
    }
}