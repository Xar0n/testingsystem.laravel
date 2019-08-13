<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Performed_Test extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'scheduled_test_id',
		'user_id',
		'date_time'
	];
}
