<?php

namespace Omnipay\Dwolla\Message;

use Mockery as m;
use Omnipay\Tests\TestCase;

class AbstractRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = m::mock('\Omnipay\Stripe\Message\AbstractRequest')->makePartial();
        $this->request->initialize();
    }

    public function testKeySecret()
    {
        $this->assertSame($this->request, $this->request->setKeySecret(array('key' => 'abc', 'secret' => '123'));
        $this->assertSame(array('key' => 'abc', 'secret' => '123'), $this->request->getKeySecret());
    }

    public function testSandbox()
    {
        $this->assertSame($this->request, $this->request->setSandboxMode(true));
        $this->assertSame(true, $this->request->getSandboxMode());
    }
}
