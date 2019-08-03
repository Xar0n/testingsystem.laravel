<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CheckId;
use App\Http\Requests\GeneralRequest;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Monolog\Formatter\TestInfoLeak;

abstract class GeneralController extends Controller
{
	public function showAll()
	{

	}

	public function showOne(CheckId $request)
	{

	}
}
