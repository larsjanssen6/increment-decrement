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
	 * Order constructor.
	 * @param OrderRepositoryInterface $orderInfo
	 */
	public function __construct(OrderRepositoryInterface $orderInfo)
	{
		$this->orderInfo = $orderInfo;
	}

	/**
	 * @param Model $model
	 * @return mixed
	 */
	public function increment(Model $model)
	{
		if($this->isValidModel($model)) {
			if(! (bool)config('increment-decrement.first_one_can_increment')) {
				if($model->{config('increment-decrement.order_column_name')} <= 1) {
					return false;
				}
			}
		}

		return $this->orderInfo->increment($model);
	}

	/**
	 * @param Model $model
	 * @return mixed
	 */
	public function decrement(Model $model)
	{
		if($this->isValidModel($model)) {
			if(! (bool)config('increment-decrement.last_one_can_decrement')) {
				if($model->{config('increment-decrement.order_column_name')} >= 1) {
					return false;
				}
			}
		}

		return $this->orderInfo->decrement($model);
	}

	/**
	 * @param Model $model
	 * @return mixed
	 */
	public function toFirst(Model $model)
	{
		if($this->isValidModel($model)) {
			return $this->orderInfo->toFirst($model);
		}
	}

	/**
	 * @param Model $model
	 * @return mixed
	 */
	public function toLast(Model $model)
	{
		if($this->isValidModel($model)) {
			return $this->orderInfo->toLast($model);
		}
	}

	/**
	 * @param Model $model
	 * @return mixed
	 */
	public function toMiddle(Model $model)
	{
		if($this->isValidModel($model)) {
			return $this->orderInfo->toMiddle($model);
		}
	}
}
