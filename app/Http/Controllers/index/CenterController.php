<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CenterController extends Controller
{
	public function __construct()
    {
        $this->Middleware('center');
    }

    public function center()
    {
    	$data = request()->get('data');
    	return view('index.center.center',['data'=>$data]);
    }
}
