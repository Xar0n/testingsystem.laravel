<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'title',
		'description',
		'time',
		'date'
	];

	protected $dates = ['date'];

	public function scopePublished($query)
	{
		$query->where('date', '<=', Carbon::now());
	}
}
