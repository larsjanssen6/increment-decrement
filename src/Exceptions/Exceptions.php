<?php

namespace LarsJanssen\IncrementDecrement\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Exceptions extends Exception
{
    /**
     * @param Model $model
     *
     * @return static
     */
    public static function columnNotFound(Model $model)
    {
        return new static("Could not find specified column on table `{$model->getTable()}`.");
    }

    /**
     * @return static
     */
    public static function columnNotSet()
    {
        return new static('Column not set in increment-decrement config file.');
    }

    /**
     * @return static
     */
    public static function numberUnValid($number)
    {
        return new static("Value `{$number}` is not a number.");
    }

    /**
     * @return static
     */
    public static function numberNotPositive($number)
    {
        return new static("Value `{$number}` must be positive.");
    }
}
