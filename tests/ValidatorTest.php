<?php

class ValidatorTest extends PHPUnit_Framework_TestCase
{

    /**
     * test instance
     *
     * @test
     */
    public function testInstance()
    {
        $this->assertInstanceOf('\EasyCoding\Validator', new \EasyCoding\Validator);
    }

    /**
     * testPassesByDefault
     *
     * @test
     */
    public function testPassesByDefault()
    {
        $v = new \EasyCoding\Validator();

        $this->assertTrue($v->passes(), 'Failed asserting that validation passes by default');
    }

    /**
     * testRequiredMethod
     *
     * @test
     */
    public function testRequiredMethod()
    {
        $inputs = array('name' => 'hello');
        $rules = array('name' => 'required');

        $v = new \EasyCoding\Validator($inputs, $rules);

        $this->assertTrue($v->passes(), 'Failed asserting that required validation fails if empty value');
        $this->assertCount(0, $v->getErrors(), 'Failed asserting that they were no errors');
    }

    /**
     * testRequiredMethodFails
     *
     * @test
     */
    public function testRequiredMethodFails()
    {
        $inputs = array('name' => '');
        $rules = array('name' => 'required');

        $v = new \EasyCoding\Validator($inputs, $rules);

        $this->assertFalse($v->passes(), 'Failed asserting that required validation fails if empty value');
        $this->assertCount(1, $v->getErrors(), 'Failed asserting that errors length is one');
        $this->assertArrayHasKey('name', $v->getErrors(), 'Failed asserting that errors contains name');
    }

    /**
     * testExpectedErrorMessage
     *
     * @test
     */
    public function testExpectedErrorMessage()
    {
        $inputs = array('name' => '');
        $rules = array('name' => 'required');

        $v = new \EasyCoding\Validator($inputs, $rules);

        $errors = $v->getErrors();

        $this->assertEquals('name, rule: required', $errors['name'], 'Failed asserting that message is outputed correctly');
    }

    /**
     * testRequiredCustomMessage
     *
     * @test
     */
    public function testRequiredCustomMessage()
    {
        $inputs = array('name' => '');
        $rules = array('name' => 'required');
        $messages = array('name' => 'el nombre es obligatorio');

        $v = new \EasyCoding\Validator($inputs, $rules, $messages);

        $errors = $v->getErrors();

        $this->assertEquals($messages['name'], $errors['name'], 'Failed asserting that custom message was passed in');
    }

    /**
     * testArrayMethod
     *
     * @test
     */
    public function testArrayMethod()
    {
        $inputs = array('array' => array());
        $rules = array('array' => 'array');

        $v = new \EasyCoding\Validator($inputs, $rules);

        $this->assertTrue($v->passes());

        $this->assertEquals(array(), $inputs['array'], 'Failed asserting that array method works');
    }

    /**
     * testArrayMethodFails
     *
     * @test
     */
    public function testArrayMethodFails()
    {
        $inputs = array('array' => '');
        $rules = array('array' => 'array');

        $v = new \EasyCoding\Validator($inputs, $rules);

        $this->assertFalse($v->passes());

        $this->assertNotEquals(array(), $inputs['array'], 'Failed asserting that array method works');
    }

    /**
     * testEmailMethod
     *
     * @test
     */
    public function testEmailMethod()
    {
        $inputs = array('email' => 'your@email.com');
        $rules = array('email' => 'email');

        $v = new \EasyCoding\Validator($inputs, $rules);

        $this->assertTrue($v->passes());
    }

    /**
     * testEmailMethodFails
     *
     * @test
     */
    public function testEmailMethodFails()
    {
        $inputs = array('email' => 'your');
        $rules = array('email' => 'email');

        $v = new \EasyCoding\Validator($inputs, $rules);

        $this->assertFalse($v->passes());
    }

    /**
     * testNumericMethod
     *
     * @test
     */
    public function testNumericMethod()
    {
        $inputs = array('number' => '1', 'othernumber' => 2);
        $rules = array('number' => 'numeric', 'othernumber' => 'numeric');

        $v = new \EasyCoding\Validator($inputs, $rules);

        $this->assertTrue($v->passes());
    }

    /**
     * testNumericMethodFails
     *
     * @test
     */
    public function testNumericMethodFails()
    {
        $inputs = array('number' => 'nonumber');
        $rules = array('number' => 'numeric');

        $v = new \EasyCoding\Validator($inputs, $rules);

        $this->assertFalse($v->passes());
    }

}
