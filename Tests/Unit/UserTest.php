<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
	protected $user;

	public function setUp()
	{
		$this->user = new \App\Models\User;
	}

	public function test_That_We_Can_Get_The_First_Name()
	{
		$this->user->setFirstName('Neveo');
		$this->assertEquals($this->user->getFirstName(), 'Neveo');
	}

	public function testThatWeCanGetTheLastName()
	{
		$this->user->setLastName('Harrison');
		$this->assertEquals($this->user->getLastName(), 'Harrison');
	}

	public function testFullNameIsReturned()
	{
		$this->user->setFirstName('Neveo');
		$this->user->setLastName('Harrison');
		$this->assertEquals($this->user->getFullName(), 'Neveo Harrison');
	}

	public function testFirstAndLastNamesAreTrimmed()
	{
		$this->user->setFirstName('  Neveo ');
		$this->user->setLastName(' Harrison        ');
		$this->assertEquals($this->user->getFirstName(), 'Neveo');
		$this->assertEquals($this->user->getLastName(), 'Harrison');
	}

	public function testEmailAddressCanBeSet()
	{
		$user = new \App\Models\User;

		$user->setEmail('n@neveo.com');
		$this->assertEquals($user->getEmail(), 'n@neveo.com');

	}

	public function testEmailVariablesContainCorrectValues()
	{
		$this->user->setFirstName('Neveo');
		$this->user->setLastName('Harrison');
		$this->user->setEmail('n@neveo.com');
		$emailVariables = $this->user->getEmailVariables();
		$this->assertArrayHasKey('full_name', $emailVariables);
		$this->assertArrayHasKey('email', $emailVariables);
		$this->assertEquals($emailVariables['full_name'], 'Neveo Harrison');
		$this->assertEquals($emailVariables['email'], 'n@neveo.com');

	}
}


















