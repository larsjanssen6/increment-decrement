<?php

namespace LarsJanssen\IncrementDecrement;

use Illuminate\Support\Facades\Facade;

class OrderFacade extends Facade
{
	/**
	 * Get the registered name of the component.
	 */
	protected static function getFacadeAccessor() : string
	{
		return 'order';
	}
}
