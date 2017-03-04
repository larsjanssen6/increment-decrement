<?php

namespace LarsJanssen\IncrementDecrement\Test\core;

use LarsJanssen\IncrementDecrement\Test\TestCase;
use LarsJanssen\IncrementDecrement\Test\TestModel;

class SwitchModelsTest extends TestCase
{
    /** @test */
    public function two_models_switch()
    {
        $row1 = TestModel::where('name', 'food')->first();
        $row2 = TestModel::where('name', 'people')->first();

        $this->assertEquals(1, $row1->order);
        $this->assertEquals(5, $row2->order);

        $this->order->switchModels($row1, $row2);

        $row1 = TestModel::where('name', 'food')->first();
        $row2 = TestModel::where('name', 'people')->first();

        $this->assertEquals(5, $row1->order);
        $this->assertEquals(1, $row2->order);
    }
}
