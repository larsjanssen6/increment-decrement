<?php

namespace LarsJanssen\IncrementDecrement\Repository;

use Illuminate\Database\Eloquent\Model;

interface OrderRepositoryInterface
{
	/**
	 * @param Model $model
	 * @return mixed
	 */
	public function increment(Model $model);

	/**
	 * @param Model $model
	 * @return mixed
	 */
	public function decrement(Model $model);

	/**
	 * @param Model $model
	 * @return mixed
	 */
	public function toFirst(Model $model);

	/**
	 * @param Model $model
	 * @return mixed
	 */
	public function toLast(Model $model);

	/**
	 * @param Model $model
	 * @return mixed
	 */
	public function toMiddle(Model $model);

	/**
	 * @param Model $model
	 * @return mixed
	 */
	public function count(Model $model);
}
