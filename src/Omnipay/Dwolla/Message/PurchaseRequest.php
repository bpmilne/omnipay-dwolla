<?php

namespace Omnipay\Dwolla\Message;

/**
 * Dwolla Purchase Request
 */
class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $subtotal = 0;

        foreach ($this->request->getParameter('gatewaySession') as $product) {
            $subtotal += floatval($product['Price']) * floatval($product['Quantity']);
        }

        $discount = $this->request->getParameter('discount') ? $this->request->getParameter('discount') : 0;
        $shipping = $this->request->getParameter('shipping') ? $this->request->getParameter('shipping') : 0;
        $tax = $this->request->getParameter('tax') ? $this->request->getParameter('tax') : 0;

        $keysec = $this->getParameter('key_secret');

        $data = array('Key'                 => $keysec['key'],
                      'Secret'              => $keysec['secret'],
                      'AllowFundingSources' => $this->request->getParameter('AllowFundingSources'),
                      'AllowGuestCheckout'  => $this->request->getParameter('AllowGuestCheckout'),
                      'Callback' => $this->request->getParameter('Callback') ?
                        $this->request->getParameter('Callback') : null,
                      'Redirect' => $this->request->getParameter('Redirect') ?
                        $this->request->getParameter('Redirect') : null,
                      'PurchaseOrder'       => array(
                        'DestinationId' => $this->request->getParameter('DestinationId'),
                        'orderItems'    => $this->request->getParameter('gatewaySession'),
                        'discount'      => $discount,
                        'shipping'      => $shipping,
                        'tax'           => $tax,
                        'total'         => round($subtotal - $discount + $shipping + $tax, 2),
                        'notes' => $this->request->getParameter('notes') ?
                          $this->request->getParameter('notes') : null
                      )
                     );

        return $data;
    }

    public function getEndpoint()
    {
        return ($this->request->getParameter('sandbox') ? $this->sandbox_host : $this->host) . 'payment/request/';
    }
}
