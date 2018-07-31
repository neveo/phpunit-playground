<?php

//use PHPUnit\Framework\TestCase;

class CollectionTest extends \PHPUnit\Framework\TestCase
{
	public function test_Empty_Instantiated_Collection_Returns_No_Items()
	{
		$collection = new \App\Support\Collection;

		$this->assertEmpty($collection->get());
	}

	public function test_Count_Is_Correct_For_Items_Passed_In()
	{
		$collection = new \App\Support\Collection([
			'one', 'two', 'three'
		]);

		$this->assertEquals(3, $collection->count());
	}

	public function test_Items_Returned_Match_Items_Passed_In()
	{
		$collection = new \App\Support\Collection([
			'one', 'two'
		]);

		$this->assertCount(2, $collection->get());
		$this->assertEquals($collection->get()[0], 'one');
		$this->assertEquals($collection->get()[1], 'two');
	}

	public function test_Collection_Is_Instance_Of_Iterator_aggregate()
	{
		$collection = new \App\Support\Collection();

		$this->assertInstanceOf(IteratorAggregate::class, $collection);
	}

	public function test_Collection_Can_Be_Iterated()
	{
		$collection = new \App\Support\Collection([
			'one', 'two', 'three'
		]);

		$items=[];
		foreach($collection as $item){
			$items[] = $item;
		}

		$this->assertCount(3, $items);
		$this->assertInstanceOf(ArrayIterator::class, $collection->getIterator());
	}

	public function test_Collection_Can_Be_Merged_With_Another_Collection()
	{
		$collection1 = new \App\Support\Collection(['one', 'two']);
		$collection2 = new \App\Support\Collection(['three', 'four', 'five']);

		$collection1->merge($collection2);	

		$this->assertCount(5, $collection1->get());
		$this->assertEquals(5, $collection1->count());	
	}

	public function test_Can_Add_To_Existing_Collection()
	{
		$collection = new \App\Support\Collection(['one', 'two']);

		$collection->add(['three']);
		$this->assertEquals(3, $collection->count());
		$this->assertCount(3, $collection->get());
	}

	public function test_Returns_Json_Encoded_Items()
	{
		$collection = new \App\Support\Collection([
			['username' => 'neveo'],
			['username' => 'mexico'],
		]);

		$this->assertInternalType('string', $collection->toJson());
		$this->assertEquals('[{"username":"neveo"},{"username":"mexico"}]', $collection->toJson());
	}

	public function test_Json_encoding_A_Collection_Object_Returns_Json()
	{
		$collection = new \App\Support\Collection([
			['username' => 'neveo'],
			['username' => 'mexico'],
		]);

		$encoded = json_encode($collection);	
		
		$this->assertInternalType('string', $encoded);
		$this->assertEquals('[{"username":"neveo"},{"username":"mexico"}]', $encoded);	
	}

}
