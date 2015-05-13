<?php

class ValidatorTest extends PHPUnit_Framework_TestCase {

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
   * testRequiredMethodPasses
   *
   * @test
   */
  public function testRequiredMethodPasses()
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

}
