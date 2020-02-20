<?php
namespace App\DataProviders;

class DataTypeProvider extends DataProvider {

	public static function data()
	{
		return [
		1  => 'Normal',
		2 => 'Average',
		];
	}
}
