<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\center;
use DB;

class GoodsController extends Controller
{
    public function __construct()
    {
        $this->Middleware('center');
    }

    public function index()
    {
    	// $data = center::where(['id'=>$id])->first();
        $data = request()->get('data');
        return  view('index/goods/index',['data'=>$data]);
    }

}
