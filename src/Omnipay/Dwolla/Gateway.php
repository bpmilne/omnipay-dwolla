<?php

namespace Omnipay\Dwolla;

use Omnipay\Common\AbstractGateway;
use Omnipay\Dwolla\Message\PurchaseRequest;
use Omnipay\Dwolla\Message\AbstractRequest;

/**
 * Dwolla Gateway
 *
 * @link https://developers.dwolla.com/dev/docs
 */

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Dwolla';
    }

    /*
    View all parameters at: https://developers.dwolla.com/dev/pages/gateway#server-to-server
    */
    public function getDefaultParameters()
    {
        return array(
            // Required
            'Key' => false,
            'Secret' => false,
            'sandbox' => false,
            'gatewaySession' => false,
            'purchaseOrder' => false,
            'Callback' => false,
            'Redirect' => false,
            'DestinationId' => false,
            'shipping' => false,
            'tax' => false,

            // Optional, set to defaults
            'discount' => false,
            'notes' => false,
            'AllowFundingSources' => true,
            'AllowGuestCheckout'  => true
        );
    }

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

    /**
    *   $parameters = array(
    *      'Name' => $name,
    *      'Description' => $description,
    *      'Price' => $price,
    *      'Quantity' => $quantity
    *   );
    */

    public function addItem(array $parameters = array())
    {
        if (!$this->getParameter('gatewaySession')) {
            $this->clearItems();
        }
        return $this->setParameter('gatewaySession', $parameters);
    }
    public function clearItems()
    {
        return $this->setParameter('gatewaySession', array());
    }

    public function getItems()
    {
        return $this->getParameter('gatewaySession');
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Dwolla\Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Dwolla\Message\PurchaseRequest', $parameters);
    }
}
