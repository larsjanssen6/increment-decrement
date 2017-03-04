<?php

namespace LarsJanssen\IncrementDecrement\Test\core;

use LarsJanssen\IncrementDecrement\Test\TestCase;
use LarsJanssen\IncrementDecrement\Test\TestModel;

class ToLastTest extends TestCase
{
    /** @test */
    public function a_row_goes_to_last()
    {
        $row = TestModel::first();

        $this->assertEquals(1, $row->order);
        $this->order->toLast($row);
        $this->assertEquals(5, $row->order);

        $this->assertEquals(1, TestModel::where('name', 'work')->first()->order);
        $this->assertEquals(2, TestModel::where('name', 'children')->first()->order);
        $this->assertEquals(3, TestModel::where('name', 'ict')->first()->order);
        $this->assertEquals(4, TestModel::where('name', 'people')->first()->order);
    }
}
