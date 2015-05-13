# validator

[![Build Status](https://travis-ci.org/ibandominguez/validator.svg?branch=travis)](https://travis-ci.org/ibandominguez/validator)

> validator is helper class for repetitive validation processes
> It allows you to

## Getting Started

In your application:

```php

$inputs = array('name' => '');
$rules = array('name' => 'required');

$v = new Validator($inputs, $rules);

$v->passes(); // => false
$v->getErrors(); // => array('name' => 'name is required');

```

## License

MIT © Ibán Domínguez
