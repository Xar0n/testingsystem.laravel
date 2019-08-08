<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variant_Question extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'question_id',
		'description'
	];
}
