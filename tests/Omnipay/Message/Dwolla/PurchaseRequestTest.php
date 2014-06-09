<?php

namespace Omnipay\Dwolla\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->addItem(array('name' => "NOODLES",
                                      'description' => "POODLES",
                                      'price' => 1,
                                      'quantity' => 1));
        $this->request->initialize(
                array('Key'                 => 'lRlAsej0WiwbXcvXv3Y4JaMD6uEt96kDs78fZNApKBkl8De7rD',
                      'Secret'              => 'HGYW7weJfk+QC50x5TdW+cuuMEIyoYRIQE/FDr3XAAf5YnOvX2',
                      'AllowFundingSources' => $this->request->getParameter('AllowFundingSources'),
                      'AllowGuestCheckout'  => $this->request->getParameter('AllowGuestCheckout'),
                      'Callback'            => $this->request->getParameter('Callback') ? 
                       $this->request->getParameter('Callback') : null,
                      'Redirect'            => $this->request->getParameter('Redirect') ?
                       $this->request->getParameter('Redirect') : null,
                      'PurchaseOrder'       => array(
                        'DestinationId' => '812-111-7219',
                        'orderItems'    => $this->request->getParameter('gatewaySession'),
                        'discount'      => $discount,
                        'shipping'      => $shipping,
                        'tax'           => $tax,
                        'total'         => round($subtotal - $discount + $shipping + $tax, 2),
                        'notes'         => $this->request->getParameter('notes') ? $this->request->getParameter('notes') : null
                      )
        ));
    }

    public function testCaptureIsTrue()
    {
        $data = $this->request->getData();
        print_r($data);
    }
}
