<?php

namespace Omnipay\RocketGate\Message;

/**
 * Class CompletePurchaseRequest
 *
 * @date      2019-08-21
 * @author    markbonnievestil (mbvestil@gmail.com)
 */
class CompletePurchaseRequest extends PurchaseRequest
{
    /**
     * @return mixed
     */
    public function getPares()
    {
        return $this->getParameter('pares');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setPares($value)
    {
        return $this->setParameter('pares', $value);
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('transactionReference', 'pares');

        $data = parent::getData();

        $data['TRANSACT_ID']   = $this->getTransactionReference();
        $data['PARES']         = $this->getPares();
        $data['USE_3D_SECURE'] = 'FALSE';

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function serviceMethod()
    {
        return 'PerformPurchase';
    }
}

