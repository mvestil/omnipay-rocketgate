<?php

namespace Omnipay\RocketGate\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;
use RocketGate\Sdk\GatewayResponse;

/**
 * Class Response
 *
 * This class is for retrieving responses from RocketGate API
 *
 * @date      2019-08-02
 * @author    markbonnievestil (mbvestil@gmail.com)
 */

class Response extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @var GatewayResponse
     */
    protected $response;

    /**
     * Response constructor.
     *
     * @param RequestInterface $request
     * @param                  $response
     */
    public function __construct(RequestInterface $request, GatewayResponse $response)
    {
        parent::__construct($request, $response->params);

        $this->response = $response;
    }

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        if ($this->getCode() == "0") {
            return true;
        }

        return false;
    }

    /**
     * RocketGate's API does not return standard codes in a single place so we use the TRANS_STATUS_NAME as
     * the code
     *
     * @return null|string
     */
    public function getCode()
    {
        return $this->response->Get(GatewayResponse::RESPONSE_CODE());
    }

    /**
     * @return null|string
     */
    public function getMessage()
    {
        return $this->response->Get(GatewayResponse::EXCEPTION());
    }

    /**
     * @return null|string
     */
    public function getTransactionReference()
    {
        return $this->response->Get(GatewayResponse::TRANSACT_ID());
    }

    /**
     * @return string|null
     */
    public function getCardReference()
    {
        return $this->response->Get(GatewayResponse::CARD_HASH());
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return $this->getReasonCode() == '202';
    }

    /**
     * @return string|null
     */
    public function getReasonCode()
    {
        return $this->response->Get(GatewayResponse::REASON_CODE());
    }

    /**
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->response->Get(GatewayResponse::ACS_URL());
    }

    /**
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'POST';
    }

    /**
     * @return array|mixed
     */
    public function getRedirectData()
    {
        if ($this->isRedirect()) {
            return $this->data;
        }
    }
}