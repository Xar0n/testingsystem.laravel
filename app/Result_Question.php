<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result_Question extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'result',
		'question',
		'answer',
		'flag'
	];
	public function result()
	{
		$this->belongsTo('App\Result');
	}
}
