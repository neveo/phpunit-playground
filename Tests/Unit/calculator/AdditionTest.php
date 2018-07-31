<?php

use PHPUnit\Framework\TestCase;

class AdditionTest extends TestCase
{
	public function test_Adds_Up_Given_Operands()
	{
		$addition = new \App\Calculator\Addition;

		$addition->setOperands([5, 10]);
		$this->assertEquals(15, $addition->calculate());
	}

	/** @test */
	public function No_Operands_Given_Throws_Exception_When_Calculating()
	{
		$this->expectException(\App\Calculator\Exceptions\NoOperandsException::class);

		$addition = new \App\Calculator\Addition;
		$addition->calculate();

	}
}