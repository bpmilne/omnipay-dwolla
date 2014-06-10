# Omnipay: Dwolla

**Dwolla off-site gateway support for the Omnipay PHP payment processing library**

[Omnipay](https://github.com/omnipay/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Dwolla support for Omnipay.

[![Build Status](https://travis-ci.org/mach-kernel/omnipay-dwolla.png?branch=master)](https://travis-ci.org/mach-kernel/omnipay-dwolla)

## Warning
This is an extremely early build of omnipay-dwolla, use this only for testing. Travis tests are currently being implemented; your mileage may
vary. 

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). omnipay-dwolla is currently not a part
of the official Omnipay branch, therefore there is no composer.json in this repository (yet).

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package:

* Dwolla (off-site)

For general usage instructions, please see the main [Omnipay](https://github.com/omnipay/omnipay)
repository.

Use Omnipay as you usually would; just pass in all Dwolla specific parameter for off-site gateway
in an array as you would for other methods. 

[Dwolla API documentation is available here.](https://developers.dwolla.com/dev/pages/gateway#server-to-server)


## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/mach-kernel/omnipay-dwolla/issues),
or better yet, fork the library and submit a pull request.
