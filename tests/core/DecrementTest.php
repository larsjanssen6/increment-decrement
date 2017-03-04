<?php
namespace LarsJanssen\IncrementDecrement\Test\core;

use LarsJanssen\IncrementDecrement\Test\TestCase;
use LarsJanssen\IncrementDecrement\Test\TestModel;

class DecrementTest extends TestCase
{
    /** @test */
    public function a_row_decrements()
    {
        $row = TestModel::where('order', 5)->first();
        $this->assertEquals(5, $row->order);
        $this->order->decrement($row);
        $this->assertEquals(1, $row->order);

        $this->assertEquals(2, TestModel::where('name', 'food')->first()->order);
        $this->assertEquals(3, TestModel::where('name', 'work')->first()->order);
        $this->assertEquals(4, TestModel::where('name', 'children')->first()->order);
        $this->assertEquals(5, TestModel::where('name', 'ict')->first()->order);
    }

    /** @test */
    public function a_row_does_not_decrement()
    {
        $this->app['config']->set('increment-decrement.last_row_can_decrement', false);

        $row = TestModel::where('order', 5)->first();

        $this->assertEquals(5, $row->order);
        $this->order->decrement($row);
        $this->assertEquals(5, $row->order);
    }
}