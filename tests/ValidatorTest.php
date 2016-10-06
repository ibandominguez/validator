<?php

/**
 * IbanDominguez\Validator\Validator
 *
 * PHP Version >= 5.3.0
 *
 * @author    Ibán Domínguez <ibandominguez@hotmail.com>
 * @copyright 2014-2015 Ibán Domínguez (http://www.ibandominguez.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/ibandominguez/validator
 */

class ValidatorTest extends PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf('IbanDominguez\Validator\Validator', new IbanDominguez\Validator\Validator);
    }

    public function testPassesByDefault()
    {
        $v = new IbanDominguez\Validator\Validator();

        $this->assertTrue($v->passes(), 'Failed asserting that validation passes by default');
    }

    public function testRequiredMethod()
    {
        $inputs = array('name' => 'hello');
        $rules = array('name' => 'required');

        $v = new IbanDominguez\Validator\Validator($inputs, $rules);

        $this->assertTrue($v->passes(), 'Failed asserting that required validation fails if empty value');
        $this->assertCount(0, $v->getErrors(), 'Failed asserting that they were no errors');
    }

    public function testRequiredMethodFails()
    {
        $inputs = array('name' => '');
        $rules = array('name' => 'required');

        $v = new IbanDominguez\Validator\Validator($inputs, $rules);

        $this->assertFalse($v->passes(), 'Failed asserting that required validation fails if empty value');
        $this->assertCount(1, $v->getErrors(), 'Failed asserting that errors length is one');
        $this->assertArrayHasKey('name', $v->getErrors(), 'Failed asserting that errors contains name');
    }

    public function testExpectedErrorMessage()
    {
        $inputs = array('name' => '');
        $rules = array('name' => 'required');

        $v = new IbanDominguez\Validator\Validator($inputs, $rules);

        $errors = $v->getErrors();

        $this->assertEquals('name, rule: required', $errors['name'], 'Failed asserting that message is outputed correctly');
    }

    public function testRequiredCustomMessage()
    {
        $inputs = array('name' => '');
        $rules = array('name' => 'required');
        $messages = array('name' => 'el nombre es obligatorio');

        $v = new IbanDominguez\Validator\Validator($inputs, $rules, $messages);

        $errors = $v->getErrors();

        $this->assertEquals($messages['name'], $errors['name'], 'Failed asserting that custom message was passed in');
    }

    public function testArrayMethod()
    {
        $inputs = array('array' => array());
        $rules = array('array' => 'array');

        $v = new IbanDominguez\Validator\Validator($inputs, $rules);

        $this->assertTrue($v->passes());

        $this->assertEquals(array(), $inputs['array'], 'Failed asserting that array method works');
    }

    public function testArrayMethodFails()
    {
        $inputs = array('array' => '');
        $rules = array('array' => 'array');

        $v = new IbanDominguez\Validator\Validator($inputs, $rules);

        $this->assertFalse($v->passes());

        $this->assertNotEquals(array(), $inputs['array'], 'Failed asserting that array method works');
    }

    public function testEmailMethod()
    {
        $inputs = array('email' => 'your@email.com');
        $rules = array('email' => 'email');

        $v = new IbanDominguez\Validator\Validator($inputs, $rules);

        $this->assertTrue($v->passes());
    }

    public function testEmailMethodFails()
    {
        $inputs = array('email' => 'your');
        $rules = array('email' => 'email');

        $v = new IbanDominguez\Validator\Validator($inputs, $rules);

        $this->assertFalse($v->passes());
    }

    public function testNumericMethod()
    {
        $inputs = array('number' => '1', 'othernumber' => 2);
        $rules = array('number' => 'numeric', 'othernumber' => 'numeric');

        $v = new IbanDominguez\Validator\Validator($inputs, $rules);

        $this->assertTrue($v->passes());
    }

    public function testNumericMethodFails()
    {
        $inputs = array('number' => 'nonumber');
        $rules = array('number' => 'numeric');

        $v = new IbanDominguez\Validator\Validator($inputs, $rules);

        $this->assertFalse($v->passes());
    }
}
