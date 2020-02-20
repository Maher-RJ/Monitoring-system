<?php
namespace App\DataProviders;

class TypeProvider extends DataProvider {

	public static function data()
	{
		return [
		1 => 'pH',
		2 => 'Soil Moisture',
		3 => 'Air Humidity',
		4 => 'Light Intensity',
		5 => 'Air Temperature',
		6 =>'Soil Temperature'
		];
	}
}
