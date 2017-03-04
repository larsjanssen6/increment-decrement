<?php

namespace LarsJanssen\IncrementDecrement\Test\core;

use LarsJanssen\IncrementDecrement\Test\TestCase;
use LarsJanssen\IncrementDecrement\Test\TestModel;

class ToFirstTest extends TestCase
{
    /** @test */
    public function a_row_goes_to_first()
    {
        $row = TestModel::where('order', 4)->first();

        $this->assertEquals(4, $row->order);
        $this->order->toFirst($row);
        $this->assertEquals(1, $row->order);

        $this->assertEquals(2, TestModel::where('name', 'food')->first()->order);
        $this->assertEquals(3, TestModel::where('name', 'work')->first()->order);
        $this->assertEquals(4, TestModel::where('name', 'children')->first()->order);
        $this->assertEquals(5, TestModel::where('name', 'people')->first()->order);
    }
}
