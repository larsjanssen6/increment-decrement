<?php

namespace LarsJanssen\IncrementDecrement\Repository;

use Illuminate\Database\Eloquent\Model;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @param Model $model
     *
     * @return bool
     */
    public function increment(Model $model)
    {
        if ($model->{config('increment-decrement.order_column_name')} != 1) {
            $model::where(config('increment-decrement.order_column_name'), $model->{config('increment-decrement.order_column_name')} - 1)->increment(config('increment-decrement.order_column_name'));
            $model->decrement(config('increment-decrement.order_column_name'));

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
        if ($model->{config('increment-decrement.order_column_name')} != $this->count($model)) {
            $model::where(config('increment-decrement.order_column_name'), $model->{config('increment-decrement.order_column_name')} + 1)->decrement(config('increment-decrement.order_column_name'));
            $model->increment(config('increment-decrement.order_column_name'));

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
        if ($model->{config('increment-decrement.order_column_name')} != 1) {
            $models = $model::where(config('increment-decrement.order_column_name'), '<', $model->{config('increment-decrement.order_column_name')})->get();
            $models->each->increment(config('increment-decrement.order_column_name'));
            $model->{config('increment-decrement.order_column_name')} = 1;
            $model->save();

            return false;
        }

        return true;
    }

    /**
     * @param Model $model
     *
     * @return bool
     */
    public function toLast(Model $model)
    {
        $last = $this->count($model);

        if ($last != $model->{config('increment-decrement.order_column_name')}) {
            $models = $model::where(config('increment-decrement.order_column_name'), '>', $model->{config('increment-decrement.order_column_name')})->get();
            $models->each->decrement(config('increment-decrement.order_column_name'));
            $model->{config('increment-decrement.order_column_name')} = $last;
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
        $between = [$model->{config('increment-decrement.order_column_name')}, $middle];

        if ($model->{config('increment-decrement.order_column_name')} != $middle) {
            if ($model->{config('increment-decrement.order_column_name')} > $middle) {
                $result = $model::whereBetween(config('increment-decrement.order_column_name'), array_reverse($between))->get();
                $result->each->increment(config('increment-decrement.order_column_name'));
            }

            if ($model->{config('increment-decrement.order_column_name')} < $middle) {
                $result = $model::whereBetween(config('increment-decrement.order_column_name'), $between)->get();
                $result->each->decrement(config('increment-decrement.order_column_name'));
            }

            $model->{config('increment-decrement.order_column_name')} = $middle;
            $model->save();

            return true;
        }

        return false;
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
