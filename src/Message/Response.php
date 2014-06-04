<?php

namespace Omnipay\Dwolla\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Dwolla Response
 */
class Response extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful()
    {
        return $this->data['Result'] == "Failure";
    }

    public function isRedirect() { return $this->isSuccessful(); }

    public function getTransactionReference()
    {
        if (isset($this->data['CheckoutId']) { return $this->data['CheckoutId']; }
    }

    public function getRedirectMethod() { return 'GET'; }

    public function getRedirectData() { return null; }

    public function getRedirectUrl()
    {
        return $this->host . "payment/checkout/" . $this->getTransactionReference();
    }

    public function getMessage()
    {
        if (!$this->isSuccessful()) { return $this->data['Message']; }
    }
}
