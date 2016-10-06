# validator

[![Build Status](https://travis-ci.org/ibandominguez/validator.svg?branch=travis)](https://travis-ci.org/ibandominguez/validator)
[![Latest Stable Version](https://poser.pugx.org/ibandominguez/validator/v/stable)](https://packagist.org/packages/ibandominguez/validator) [![Total Downloads](https://poser.pugx.org/ibandominguez/validator/downloads)](https://packagist.org/packages/ibandominguez/validator) [![Latest Unstable Version](https://poser.pugx.org/ibandominguez/validator/v/unstable)](https://packagist.org/packages/ibandominguez/validator) [![License](https://poser.pugx.org/ibandominguez/validator/license)](https://packagist.org/packages/ibandominguez/validator)

> validator is a helper class for repetitive validation processes.

## Getting Started

Clone or Download this package or install via composer

> composer require ibandominguez/validator

## Available Rules by '20/Jun/15'

| Title | Description |
| ----- | ----------- |
| required | check if the given input exists and it is not empty  |
| email  | check if the given input is a valid email  |
| array | check if the given input is a valid array |
| numeric | check if the given input is a numeric value |
| string | check if the given input is a string value |

## Rules Roadmap

* min
* max
* between
* date
* date format
* alpha
* alpha numeric

## Use example

In your application:

```php
<?php

require __DIR__.'/vendor/autoload.php';

$inputs = array('name' => '', 'email' => 'johndoe@email.com');
$rules = array('name' => 'required', 'email' => 'required|email');

$v = new IbanDominguez\Validator\Validator($inputs, $rules);

$v->passes(); // => false
$v->getErrors(); // => array('name' => 'name, rule: required');

```

## License

MIT © Ibán Domínguez
