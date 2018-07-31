<?php

namespace App\Calculator;

class Calculator
{
	protected $operations = [];

	public function setOperation(OperationInterface $operation)
	{
		$this->operations[] = $operation;
	}

	public function setOperations(array $operations)
	{
/*		Version 1
		foreach($operations as $index => $operation){
			if(!$operation instanceof OperationInterface){
				unset($operations[$index]);
			}
		}*/

		$filteredOperations = array_filter($operations, function($operation){
/*			Version 2
			if(!$operation instanceof OperationInterface){
				return false;
			}
			return true;*/
			return $operation instanceof OperationInterface;
		});

		$this->operations = array_merge($this->operations, $filteredOperations /* Version 1$operations*/);
	}

	public function getOperations()
	{
		return $this->operations;
	}

	public function Calculate()
	{		
		if(count($this->operations) > 1){
/*			Refactor 1
			$result = null;
			foreach($this->operations as $operation){
				$result[] = $operation->calculate();
			}

			return $result;*/

			return array_map(function ($operation){
				return $operation->calculate();
			}, $this->operations);
		}

		return $this->operations[0]->calculate();
	}

}




