<?php

namespace LarsJanssen\IncrementDecrement\Test;

use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    public $order;

    public function setUp()
    {
        parent::setUp();
        $this->setUpDatabase($this->app);
        $this->order = $this->app->make('order');
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \LarsJanssen\IncrementDecrement\IncrementDecrementServiceProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $app['config']->set('app.key', '6rE9Nz59bGRbeMATftriyQjrpF7DcOQm');
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function setUpDatabase($app)
    {
        $app['db']->connection()->getSchemaBuilder()->create('forum', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('order');
            $table->rememberToken();
            $table->timestamps();
        });

        TestModel::create(['name' => 'food',        'order' => 1]);
        TestModel::create(['name' => 'work',        'order' => 2]);
        TestModel::create(['name' => 'children',    'order' => 3]);
        TestModel::create(['name' => 'ict',         'order' => 4]);
        TestModel::create(['name' => 'people',      'order' => 5]);
    }
}
