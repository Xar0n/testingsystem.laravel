<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'test',
		'user',
		'result',
		'date'
	];

	public function questions()
	{

		return $this->hasMany('App\Result_Question');
	}
}
