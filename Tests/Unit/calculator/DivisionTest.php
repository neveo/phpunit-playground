<?php

use PHPUnit\Framework\TestCase;

class DivisionTest extends TestCase
{
	public function test_Divides_given_Operands()
	{
		$division = new \App\Calculator\Division;
		
		$division->setOperands([100, 2]);
		$this->assertEquals(50, $division->calculate());
	}

	/** @test */
	public function No_Operands_Given_Throws_Exception_When_Calculating()
	{
		$this->expectException(\App\Calculator\Exceptions\NoOperandsException::class);

		$addition = new \App\Calculator\Division;
		$addition->calculate();

	}

	public function test_Removes_Division_By_Zero_Operands()
	{
		$division = new \App\Calculator\Division;

		$division->setOperands([10,0,0,5,0]);
		$this->assertEquals(2, $division->calculate());		
	}

}