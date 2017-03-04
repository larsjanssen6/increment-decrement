<?php
namespace LarsJanssen\IncrementDecrement\Test\core;

use LarsJanssen\IncrementDecrement\Test\TestCase;
use LarsJanssen\IncrementDecrement\Test\TestModel;

class ToMiddleTest extends TestCase
{
    /** @test */
    public function a_row_goes_to_middle_decrements()
    {
        $row = TestModel::first();

        $this->assertEquals(1, $row->order);
        $this->order->toMiddle($row);
        $this->assertEquals(3, $row->order);

        $this->assertEquals(1, TestModel::where('name', 'work')->first()->order);
        $this->assertEquals(2, TestModel::where('name', 'children')->first()->order);
        $this->assertEquals(4, TestModel::where('name', 'ict')->first()->order);
        $this->assertEquals(5, TestModel::where('name', 'people')->first()->order);
    }

    /** @test */
    public function a_row_goes_to_middle_increments()
    {
        $row = TestModel::where('order', 5)->first();

        $this->assertEquals(5, $row->order);
        $this->order->toMiddle($row);
        $this->assertEquals(3, $row->order);

        $this->assertEquals(1, TestModel::where('name', 'food')->first()->order);
        $this->assertEquals(2, TestModel::where('name', 'work')->first()->order);
        $this->assertEquals(4, TestModel::where('name', 'children')->first()->order);
        $this->assertEquals(5, TestModel::where('name', 'ict')->first()->order);
    }
}