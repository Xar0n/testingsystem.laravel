<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'name',
		'description',
	];

	/*public function scopePublished($query)
	{
		$query->where('date', '<=', Carbon::now());
	}*/
}
