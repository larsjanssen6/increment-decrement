<?php
namespace LarsJanssen\IncrementDecrement\Test\core;

use LarsJanssen\IncrementDecrement\Test\TestCase;
use LarsJanssen\IncrementDecrement\Test\TestModel;

class SwitchIndexTest extends TestCase
{
    /** @test */
    public function switch_two_indexes()
    {
        $row1 = TestModel::where('name', 'food')->first();
        $row2 = TestModel::where('name', 'people')->first();

        $this->assertEquals(1, $row1->order);
        $this->assertEquals(5, $row2->order);

        $this->order->switchIndexes($row1, 1, 5);

        $row1 = TestModel::where('name', 'food')->first();
        $row2 = TestModel::where('name', 'people')->first();

        $this->assertEquals(5, $row1->order);
        $this->assertEquals(1, $row2->order);
    }
}