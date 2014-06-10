<?php

namespace Omnipay\Dwolla\Message;

/**
 * Dwolla Abstract Request
 *
 * @method \Omnipay\Dwolla\Message\Response send()
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $host = 'https://www.dwolla.com/';
    protected $sandbox_host = 'https://uat.dwolla.com';

    abstract public function getEndpoint();

    public function getKeySecret()
    {
        $key_secret = array('Key' => $this->getParameter('Key'), 'Secret' => $this->getParameter('Secret'));
        return $key_secret;
    }

    public function setKeySecret($key, $secret)
    {
        return ($this->setParameter('Key', $key) && $this->setParameter('Secret', $secret));
    }

    public function getSandboxMode()
    {
        return $this->getParameter('sandbox');
    }

    public function setSandboxMode($value)
    {
        return $this->setParameter('sandbox', $value);
    }

    public function getP($value)
    {
        return $this->getParameter($value);
    }

  /**
    *   $parameters = array(
    *      'Name' => $name,
    *      'Description' => $description,
    *      'Price' => $price,
    *      'Quantity' => $quantity
    *   );
    */

    public function addItem($name, $price, $quantity = 1, $description = '')
    {
        if (!$this->getParameter('gatewaySession')) {
            $this->clearItems();
        }

        $item = array(
            'Name' => $name,
            'Description' => $description,
            'Price' => $price,
            'Quantity' => $quantity
        );

        $items = $this->getParameter('gatewaySession');
        $items[] = $item;

        return $this->setParameter('gatewaySession', $items);
    }
    public function clearItems()
    {
        return $this->setParameter('gatewaySession', array());
    }

    public function getItems()
    {
        return $this->getParameter('gatewaySession');
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
            ->setHeader('Accept: application/json', 'Content-Type: application/json;charset=UTF-8')
            ->send();

        return $this->response = new Response($this, $httpResponse->json());
    }
}
