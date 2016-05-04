# validator

[![Build Status](https://travis-ci.org/ibandominguez/validator.svg?branch=travis)](https://travis-ci.org/ibandominguez/validator)
[![Latest Stable Version](https://poser.pugx.org/easycoding/validator/v/stable)](https://packagist.org/packages/easycoding/validator) [![Total Downloads](https://poser.pugx.org/easycoding/validator/downloads)](https://packagist.org/packages/easycoding/validator) [![Latest Unstable Version](https://poser.pugx.org/easycoding/validator/v/unstable)](https://packagist.org/packages/easycoding/validator) [![License](https://poser.pugx.org/easycoding/validator/license)](https://packagist.org/packages/easycoding/validator)

> validator is a helper class for repetitive validation processes.

## Getting Started

Clone or Download this package or install via composer

> composer require easycoding/validator

## Available Rules by '20/Jun/15'

| Title | Description |
| ----- | ----------- |
| required | check if the given input exists and it is not empty  |
| email  | check if the given input is a valid email  |
| array | check if the given input is a valid array |
| numeric | check if the given input is a numeric value |

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

$inputs = array('name' => '', 'email' => 'johndoe@email.com');
$rules = array('name' => 'required', 'email' => 'required|email');

$v = new \EasyGoing\Validator($inputs, $rules);

$v->passes(); // => false
$v->getErrors(); // => array('name' => 'name, rule: required');

```

## License

MIT © Ibán Domínguez
