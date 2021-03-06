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
        $items = $this->getParameter('gatewaySession');

        if (is_array($items)) {
            foreach ($items as $product) {
                $subtotal += floatval($product['Price']) * floatval($product['Quantity']);
            }
        }
        
        $discount = $this->getParameter('discount') ? $this->getParameter('discount') : 0;
        $shipping = $this->getParameter('shipping') ? $this->getParameter('shipping') : 0;
        $tax = $this->getParameter('tax') ? $this->getParameter('tax') : 0;

        $data = array('Key'                 => $this->getParameter('Key'),
                      'Secret'              => $this->getParameter('Secret'),
                      'AllowFundingSources' => $this->getParameter('AllowFundingSources'),
                      'AllowGuestCheckout'  => $this->getParameter('AllowGuestCheckout'),
                      'Callback' => $this->getParameter('Callback') ?
                        $this->getParameter('Callback') : null,
                      'Redirect' => $this->getParameter('Redirect') ?
                        $this->getParameter('Redirect') : null,
                      'PurchaseOrder'       => array(
                        'DestinationId' => $this->getParameter('DestinationId'),
                        'orderItems'    => $this->getParameter('gatewaySession'),
                        'discount'      => $discount,
                        'shipping'      => $shipping,
                        'tax'           => $tax,
                        'total'         => round($subtotal - $discount + $shipping + $tax, 2),
                        'notes' => $this->getParameter('notes') ?
                          $this->getParameter('notes') : null
                      )
                     );

        return $data;
    }

    public function getEndpoint()
    {
        return ($this->getParameter('sandbox') ? $this->sandbox_host : $this->host) . 'payment/request/';
    }
}
