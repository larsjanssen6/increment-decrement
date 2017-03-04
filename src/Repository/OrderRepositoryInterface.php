<?php

namespace LarsJanssen\IncrementDecrement\Repository;

use Illuminate\Database\Eloquent\Model;

interface OrderRepositoryInterface
{
    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function increment(Model $model);

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function decrement(Model $model);

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function toFirst(Model $model);

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function toLast(Model $model);

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function toMiddle(Model $model);

    /**
     * @param Model $model1
     * @param Model $model2
     * @return mixed
     */
    public function switchModels(Model $model1, Model $model2);

    /**
     * @param Model $model
     * @param $index1
     * @param $index2
     * @return mixed
     */
    public function switchIndexes(Model $model, $index1, $index2);


    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function count(Model $model);
}
