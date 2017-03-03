<?php

namespace LarsJanssen\IncrementDecrement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use LarsJanssen\IncrementDecrement\Exceptions\Exceptions;

trait HelperTrait
{
    /**
     * @param Model $model
     *
     * @throws Exceptions
     *
     * @return bool
     */
    public function isValidModel(Model $model)
    {
        if (!empty(config('increment-decrement.order_column_name'))) {
            if (Schema::hasColumn($model->getTable(), config('increment-decrement.order_column_name'))) {
                return true;
            }

            throw Exceptions::couldNotFindColumn($model);
        }

        throw Exceptions::columnNotSet();
    }
}
