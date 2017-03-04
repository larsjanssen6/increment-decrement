<?php

namespace LarsJanssen\IncrementDecrement\Test\core;

use LarsJanssen\IncrementDecrement\Test\TestCase;
use LarsJanssen\IncrementDecrement\Test\TestModel;

class IncrementTest extends TestCase
{
    /** @test */
    public function a_row_increments()
    {
        $row = TestModel::first();

        $this->assertEquals(1, $row->order);
        $this->order->increment($row);
        $this->assertEquals(5, $row->order);

        $this->assertEquals(1, TestModel::where('name', 'work')->first()->order);
        $this->assertEquals(2, TestModel::where('name', 'children')->first()->order);
        $this->assertEquals(3, TestModel::where('name', 'ict')->first()->order);
        $this->assertEquals(4, TestModel::where('name', 'people')->first()->order);
    }

    /** @test */
    public function a_row_does_not_increments()
    {
        $this->app['config']->set('increment-decrement.first_row_can_increment', false);

        $row = TestModel::first();

        $this->assertEquals(1, $row->order);
        $this->order->increment($row);
        $this->assertEquals(1, $row->order);
    }
}
