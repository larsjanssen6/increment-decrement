<?php

namespace LarsJanssen\IncrementDecrement\Repository;

use Illuminate\Database\Eloquent\Model;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @var mixed
     */
    public $column;

    /**
     * OrderRepository constructor.
     */
    public function __construct()
    {
        $this->column = config('increment-decrement.order_column_name');
    }

    /**
     * @param Model $model
     *
     * @return bool
     */
    public function increment(Model $model)
    {
        if ($model->{$this->column} != 1) {
            $model::where($this->column, $model->{$this->column} - 1)->increment($this->column);
            $model->decrement($this->column);

            return true;
        }

        return $this->toLast($model);
    }

    /**
     * @param Model $model
     *
     * @return bool
     */
    public function decrement(Model $model)
    {
        if ($model->{$this->column} != $this->count($model)) {
            $model::where($this->column, $model->{$this->column} + 1)->decrement($this->column);
            $model->increment($this->column);

            return true;
        }

        return $this->toFirst($model);
    }

    /**
     * @param Model $model
     *
     * @return bool
     */
    public function toFirst(Model $model)
    {
        if ($model->{$this->column} != 1) {
            $models = $model::where($this->column, '<', $model->{$this->column})->get();
            $models->each->increment($this->column);
            $model->{$this->column} = 1;
            $model->save();

            return true;
        }

        return false;
    }

    /**
     * @param Model $model
     *
     * @return bool
     */
    public function toLast(Model $model)
    {
        $last = $this->count($model);

        if ($last != $model->{$this->column}) {
            $models = $model::where($this->column, '>', $model->{$this->column})->get();
            $models->each->decrement($this->column);
            $model->{$this->column} = $last;
            $model->save();

            return true;
        }

        return false;
    }

    /**
     * @param Model $model
     *
     * @return bool
     */
    public function toMiddle(Model $model)
    {
        $middle = number_format($this->count($model) / 2);
        $between = [$model->{$this->column}, $middle];

        if ($model->{$this->column} != $middle) {
            if ($model->{$this->column} > $middle) {
                $result = $model::whereBetween($this->column, array_reverse($between))->get();
                $result->each->increment($this->column);
            }

            if ($model->{$this->column} < $middle) {
                $result = $model::whereBetween($this->column, $between)->get();
                $result->each->decrement($this->column);
            }

            $model->{$this->column} = $middle;
            $model->save();

            return true;
        }

        return false;
    }

    /**
     * @param Model $model1
     * @param Model $model2
     *
     * @return bool
     */
    public function switchModels(Model $model1, Model $model2)
    {
        $temp = $model1->{$this->column};
        $model1->{$this->column} = $model2->{$this->column};
        $model2->{$this->column} = $temp;

        $model1->save();
        $model2->save();

        return true;
    }

    /**
     * @param Model $model
     * @param $index1
     * @param $index2
     *
     * @return bool
     */
    public function switchIndexes(Model $model, $index1, $index2)
    {
        $model1 = $model::where($this->column, $index1)->first();
        $model2 = $model::where($this->column, $index2)->first();

        return $this->switchModels($model1, $model2);
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function count(Model $model)
    {
        return $model::count();
    }
}
