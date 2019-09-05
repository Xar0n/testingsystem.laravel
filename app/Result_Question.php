<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Result_Question extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'result_id',
		'question_id',
		'answer',
		'flag'
	];
	public function result()
	{
		$this->hasOne('App\Result');
	}
}
