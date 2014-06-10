<?php

namespace Omnipay\Dwolla\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->addItem("Noodle", 1, 1, "TEST");
        $this->request->addItem("Poodle", 2, 1, "TEST2");

        $this->request->setKeySecret(
            'lRlAsej0WiwbXcvXv3Y4JaMD6uEt96kDs78fZNApKBkl8De7rD',
            'HGYW7weJfk+QC50x5TdW+cuuMEIyoYRIQE/FDr3XAAf5YnOvX2'
        );

        $this->request->initialize(
            array('PurchaseOrder'   => array(
                    'DestinationId' => '812-111-7219',
                    'orderItems'    => $this->request->getP('gatewaySession'),
                    'notes'         => $this->request->getP('notes') ? $this->request->getP('notes') : null
                  )
        )
        );
    }

    public function testSendSuccess()
    {
        $response = $this->request->send();
    }
}
