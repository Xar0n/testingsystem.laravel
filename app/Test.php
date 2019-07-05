<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
	protected $fillable = [
		'title',
		'description',
		'status',
		'time',
		'date'
	];

	protected $dates = ['date'];

	public function scopePublished($query)
	{
		$query->where('date', '<=', Carbon::now());
	}
}
