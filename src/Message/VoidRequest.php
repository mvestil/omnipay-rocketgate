<?php
namespace Omnipay\RocketGate\Message;


/**
 * Class ${NAME}
 *
 * @date      2019-08-08
 * @author    markbonnievestil (mbvestil@gmail.com)
 */

class VoidRequest extends AbstractRequest
{
    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $data = parent::getData();

        $this->validate('transactionReference');

        $data['TRANSACT_ID'] = $this->getTransactionReference();

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function serviceMethod()
    {
        return 'PerformVoid';
    }
}