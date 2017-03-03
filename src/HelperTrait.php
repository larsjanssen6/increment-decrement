<?php

namespace LarsJanssen\IncrementDecrement;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use LarsJanssen\IncrementDecrement\Exceptions\Exceptions;

trait HelperTrait
{
	/**
	 * @param Model $model
	 * @return bool
	 * @throws Exceptions
	 */
	public function isValidModel(Model $model)
	{
		if(!empty(config('increment-decrement.order_column_name'))) {
			if(Schema::hasColumn($model->getTable(), config('increment-decrement.order_column_name'))) {
				return true;
			}

			throw Exceptions::couldNotFindColumn($model);
		}

		throw Exceptions::columnNotSet();
	}
}
