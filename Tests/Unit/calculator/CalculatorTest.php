<?php

use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
	public function test_Can_Set_Single_Operation()
	{
		$addition = new \App\Calculator\Addition;
		$addition->setOperands([5,10]);

		$calculator = new \App\Calculator\Calculator;
		$calculator->setOperation($addition);

		$this->assertCount(1, $calculator->getOperations());
	}

	public function test_Can_Set_Multiple_Operations()
	{
		$addition1 = new \App\Calculator\Addition;
		$addition1->setOperands([5,10]);

		$addition2 = new \App\Calculator\Addition;
		$addition2->setOperands([2,2]);

		$calculator = new \App\Calculator\Calculator;
		$calculator->setOperations([$addition1,$addition2]);

		$this->assertCount(2, $calculator->getOperations());
	}

	public function test_Operations_Are_Ignored_If_Not_Instance_Of_Operations_Interface()
	{
		$addition = new \App\Calculator\Addition;
		$addition->setOperands([5,10]);

		$calculator = new \App\Calculator\Calculator;
		$calculator->setOperations([$addition, 'cats', 'dogs']);

		$this->assertCount(1, $calculator->getOperations());			
	}

	public function test_Can_Calculate_Result()
	{
		$addition = new \App\Calculator\Addition;
		$addition->setOperands([5,10]);

		$calculator = new \App\Calculator\Calculator;
		$calculator->setOperation($addition);

		$this->assertEquals(15, $calculator->calculate());		
	}

	public function test_Calculate_Method_Returns_Multiple_Results()
	{
		$addition = new \App\Calculator\Addition;
		$addition->setOperands([5,10]); //15

		$division = new \App\Calculator\Division;
		$division->setOperands([50,2]); //25

		$calculator = new \App\Calculator\Calculator;
		$calculator->setOperations([$addition, $division]);

		$this->assertInternalType('array', $calculator->calculate());
		$this->assertEquals(15, $calculator->calculate()[0]);
		$this->assertEquals(25, $calculator->calculate()[1]);
		
	}
}
