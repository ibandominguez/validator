# validator

[![Build Status](https://travis-ci.org/ibandominguez/validator.svg?branch=travis)](https://travis-ci.org/ibandominguez/validator)

> validator is helper class for repetitive validation processes
> It allows you to

## Getting Started

Download this package or install via composer

> composer require easycoding/validator

## Available Rules by '13/May/15'

> required: check if the given input exists and it is not empty
> email: check if the given input is a valid email
> array: check if the given input is a valid array

## Use example

In your application:

```php

$inputs = array('name' => '', 'email' => 'johndoe@email.com');
$rules = array('name' => 'required', 'email' => 'required|email');

$v = new \EasyGoing\Validator($inputs, $rules);

$v->passes(); // => false
$v->getErrors(); // => array('name' => 'name is required');

```

## License

MIT © Ibán Domínguez
