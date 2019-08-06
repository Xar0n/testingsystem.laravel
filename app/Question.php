<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'description', 'true_answer', 'test_id', 'type', 'points'
	];
}
