<?php

namespace Omnipay\Dwolla\Message;

/**
 * Dwolla Abstract Request
 *
 * @method \Omnipay\Dwolla\Message\Response send()
 */
abstract class AbstractRequest extends Omnipay\Common\Message\AbstractRequest
{
    protected $host = 'https://www.dwolla.com/';
    protected $sandbox_host = 'https://uat.dwolla.com';

    abstract public function getEndpoint();

    public function getKeySecret()
    {
        return $this->getParameter('key_secret');
    }

    public function setKeySecret($value)
    {
        return $this->setParameter('key_secret', $value);
    }

    public function getSandboxMode()
    {
        return $this->getParameter('sandbox');
    }

    public function setSandboxMode($value)
    {
        return $this->setParameter('sandbox', $value);
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    public function sendData($data)
    {
        // Don't throw exceptions for 4xx errors
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                if ($event['response']->isClientError()) { 
                    $event->stopPropagation();
                }
            }
        );

        $httpRequest = $this->httpClient->createRequest(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            null,
            $data
        );
        
        $httpResponse = $httpRequest
            ->setHeaderarray('Accept: application/json', 'Content-Type: application/json;charset=UTF-8'))
            ->send();

        return $this->response = new Response($this, $httpResponse->json());
    }
}
