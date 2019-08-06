<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'test_id',
		'user_id',
		'result',
		'date'
	];

	public function questions()
	{

		return $this->hasMany('App\Result_Question');
	}
}
