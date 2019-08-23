<?php

namespace Omnipay\RocketGate\Message;

/**
 * Class ${NAME}
 *
 * @date      2019-08-08
 * @author    markbonnievestil (mbvestil@gmail.com)
 */
class RefundRequest extends AbstractRequest
{
    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $data = parent::getData();

        $this->validate('transactionReference', 'amount');

        $data['TRANSACT_ID'] = $this->getTransactionReference();
        $data['AMOUNT']      = $this->getAmount();

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function serviceMethod()
    {
        return 'PerformCredit';
    }
}