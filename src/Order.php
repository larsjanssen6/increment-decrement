<?php

namespace LarsJanssen\IncrementDecrement;

use Illuminate\Database\Eloquent\Model;
use LarsJanssen\IncrementDecrement\Repository\OrderRepositoryInterface;

class Order
{
    use HelperTrait;

    /**
     * @var OrderRepositoryInterface
     */
    protected $orderInfo;
    /**
     * @var mixed
     */
    public $column;

    /**
     * Order constructor.
     *
     * @param OrderRepositoryInterface $orderInfo
     */
    public function __construct(OrderRepositoryInterface $orderInfo)
    {
        $this->orderInfo = $orderInfo;
        $this->column = config('increment-decrement.order_column_name');
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function increment(Model $model)
    {
        if ($this->isValidModel($model)) {
            if (!(bool) config('increment-decrement.first_row_can_increment')) {
                if ($model->{$this->column} <= 1) {
                    return false;
                }
            }

            return $this->orderInfo->increment($model);
        }
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function decrement(Model $model)
    {
        if ($this->isValidModel($model)) {
            if (!(bool) config('increment-decrement.last_row_can_decrement')) {
                if ($model->{$this->column} >= 1) {
                    return false;
                }
            }

            return $this->orderInfo->decrement($model);
        }
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function delete(Model $model)
    {
        if ($this->isValidModel($model)) {
            return $this->orderInfo->delete($model);
        }
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function toFirst(Model $model)
    {
        if ($this->isValidModel($model)) {
            return $this->orderInfo->toFirst($model);
        }
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function toLast(Model $model)
    {
        if ($this->isValidModel($model)) {
            return $this->orderInfo->toLast($model);
        }
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function toMiddle(Model $model)
    {
        if ($this->isValidModel($model)) {
            return $this->orderInfo->toMiddle($model);
        }
    }

    /**
     * @param Model $model1
     * @param Model $model2
     *
     * @return mixed
     */
    public function switchModels(Model $model1, Model $model2)
    {
        if ($this->isValidModel($model1) && $this->isValidModel($model2)) {
            return $this->orderInfo->switchModels($model1, $model2);
        }
    }

    /**
     * @param Model $model
     * @param Model $index1
     * @param Model $index2
     *
     * @return mixed
     */
    public function switchIndexes(Model $model, $index1, $index2)
    {
        if ($this->isValidIndex($index1) && $this->isValidIndex($index2)) {
            return $this->orderInfo->switchIndexes($model, $index1, $index2);
        }
    }
}
