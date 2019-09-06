<?php

namespace Omnipay\RocketGate\Message;

use RocketGate\Sdk\GatewayRequest;
use RocketGate\Sdk\GatewayResponse;
use RocketGate\Sdk\GatewayService;

/**
 * Class AbstractRequest
 *
 * This is the parent class of all RocketGate requests
 *
 * @date      2019-08-02
 * @author    markbonnievestil (mbvestil@gmail.com)
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * @return string
     */
    public function getMerchantId()
    {
        return $this->getParameter('merchantID');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
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
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setMerchantPassword($value)
    {
        return $this->setParameter('merchantPassword', $value);
    }

    /**
     * @return string
     */
    public function getGeneratePostBack()
    {
        return $this->getParameter('generatePostBack');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setGeneratePostBack($value)
    {
        return $this->setParameter('generatePostBack', $value);
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function sendData($data)
    {
        $request  = new GatewayRequest();
        $response = new GatewayResponse();
        $service  = new GatewayService();

        foreach ($data as $key => $value) {
            $request->Set(GatewayRequest::{$key}(), $value);
        }

        $service->SetTestMode($this->getTestMode());
        $serviceMethod = $this->serviceMethod();

        if (!method_exists($service, $serviceMethod)) {
            throw new \Exception('GatewayService method does not exist.');
        }

        $service->{$serviceMethod}($request, $response);

        return $this->response = new Response($this, $response);
    }


    /**
     * Set the common data used in every request.
     *
     * In this gateway a certain amount of data needs to be sent
     * in every request.  This function sets those data into the
     * array and can be extended by child classes.
     *
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('merchantID', 'merchantPassword');

        $data = array(
            'MERCHANT_ID'       => $this->getMerchantId(),
            'MERCHANT_PASSWORD' => $this->getMerchantPassword(),
            // by default turn on postback if not provided
            'GENERATE_POSTBACK' => $this->getGeneratePostBack() ?: "TRUE",
        );

        return $data;
    }

    /**
     * Returns the method name to call in GatewayService class in RocketGate's PHP SDK
     *
     * @return string
     */
    abstract public function serviceMethod();
}
