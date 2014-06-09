<?php

namespace Omnipay\Dwolla;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }
    public function testPurchase()
    {
        $this->gateway->addItem(array('name' => "NOODLES",
                                      'description' => "POODLES",
                                      'price' => 1,
                                      'quantity' => 1));
        $request = $this->gateway->purchase();

        $this->assertInstanceOf('Omnipay\Dwolla\Message\PurchaseRequest', $request);
        $this->assertSame('???', $request->getAmount());
    }
}
