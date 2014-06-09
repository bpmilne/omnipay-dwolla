<?php

namespace Omnipay\Dwolla\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    public function setUp()
    {
        $getP = new ReflectionMethod('AbstractRequest', 'getParameter');
        $getP->setAccessible(true);

        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->addItem(array('name' => "NOODLES",
                                      'description' => "POODLES",
                                      'price' => 1,
                                      'quantity' => 1));
        $this->request->initialize(
                array('Key'                 => 'lRlAsej0WiwbXcvXv3Y4JaMD6uEt96kDs78fZNApKBkl8De7rD',
                      'Secret'              => 'HGYW7weJfk+QC50x5TdW+cuuMEIyoYRIQE/FDr3XAAf5YnOvX2',
                      'AllowFundingSources' => $getP('AllowFundingSources'),
                      'AllowGuestCheckout'  => $getP('AllowGuestCheckout'),
                      'Callback'            => $getP('Callback') ? 
                       $getP('Callback') : null,
                      'Redirect'            => $getP('Redirect') ?
                       $getP('Redirect') : null,
                      'PurchaseOrder'       => array(
                        'DestinationId' => '812-111-7219',
                        'orderItems'    => $getP('gatewaySession'),
                        'discount'      => $discount,
                        'shipping'      => $shipping,
                        'tax'           => $tax,
                        'total'         => round($subtotal - $discount + $shipping + $tax, 2),
                        'notes'         => $getP('notes') ? $getP('notes') : null
                      )
        ));
    }

    public function testCaptureIsTrue()
    {
        $data = $this->request->getData();
        print_r($data);
    }
}
