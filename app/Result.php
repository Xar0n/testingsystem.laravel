<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'scheduled_test_id',
		'user_id',
		'points',
		'date'
	];

	public function questions()
	{

		return $this->hasMany('App\Result_Question');
	}
}
