<?php

namespace Omnipay\RocketGate\Message;

/**
 * Class ${NAME}
 *
 * @date      2019-08-08
 * @author    markbonnievestil
 * @copyright Copyright (c) Infostream Group
 */

class RefundRequest extends AbstractRequest
{
    public function getData()
    {
        $data = parent::getData();

        // TODO

        return $data;
    }

    public function serviceMethod()
    {
        return 'PerformCredit';
    }

}