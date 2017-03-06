<?php

namespace LarsJanssen\IncrementDecrement\Test\core;

use LarsJanssen\IncrementDecrement\Test\TestCase;
use LarsJanssen\IncrementDecrement\Test\TestModel;

class DeleteTest extends TestCase
{
    /** @test */
    public function delete_first_row()
    {
        $row = TestModel::first();
        $this->assertEquals(1, $row->order);
        $this->order->delete($row);

        $this->assertEquals(1, TestModel::where('name', 'work')->first()->order);
        $this->assertEquals(2, TestModel::where('name', 'children')->first()->order);
        $this->assertEquals(3, TestModel::where('name', 'ict')->first()->order);
        $this->assertEquals(4, TestModel::where('name', 'people')->first()->order);
    }

    /** @test */
    public function delete_last_row()
    {
        $row = TestModel::where('order', 5)->first();
        $this->assertEquals(5, $row->order);
        $this->order->delete($row);

        $this->assertEquals(1, TestModel::where('name', 'food')->first()->order);
        $this->assertEquals(2, TestModel::where('name', 'work')->first()->order);
        $this->assertEquals(3, TestModel::where('name', 'children')->first()->order);
        $this->assertEquals(4, TestModel::where('name', 'ict')->first()->order);
    }

    /** @test */
    public function delete_row_in_middle()
    {
        $row = TestModel::where('order', 3)->first();
        $this->assertEquals(3, $row->order);
        $this->order->delete($row);

        $this->assertEquals(1, TestModel::where('name', 'food')->first()->order);
        $this->assertEquals(2, TestModel::where('name', 'work')->first()->order);
        $this->assertEquals(3, TestModel::where('name', 'ict')->first()->order);
        $this->assertEquals(4, TestModel::where('name', 'people')->first()->order);
    }
}
