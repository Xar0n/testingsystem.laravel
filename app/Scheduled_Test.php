<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scheduled_Test extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'time',
		'date_first',
		'time_first',
		'date_last',
		'time_last'
	];
}
