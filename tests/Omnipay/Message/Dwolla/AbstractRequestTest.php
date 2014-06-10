<?php

namespace Omnipay\Dwolla\Message;

use Mockery as m;
use Omnipay\Tests\TestCase;

class AbstractRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = m::mock('\Omnipay\Dwolla\Message\AbstractRequest')->makePartial();
        $this->request->initialize();
    }

    public function testKeySecret()
    {
        $this->request->setKeySecret('1', '2');
        $this->assertSame(array('Key' => '1', 'Secret' => '2'), $this->request->getKeySecret());
    }

    public function testSandbox()
    {
        $this->assertSame($this->request, $this->request->setSandboxMode(true));
        $this->assertSame(true, $this->request->getSandboxMode());
    }

    public function testItemAdd()
    {
        $this->assertSame($this->request, $this->request->addItem("TEST", 1, 1, "NOTE"));
        $this->assertSame(array('Name' => "TEST",
                                'Description' => "NOTE",
                                'Price' => 1,
                                'Quantity' => 1), $this->request->getItems()[0]);
    }
}
