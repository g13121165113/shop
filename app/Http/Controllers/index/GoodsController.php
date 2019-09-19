<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\goods;
class GoodsController extends Controller
{
    public function index()
    {
        return  view('index/goods/index');
    }

    public function layouts()
    {
        //$goods = goods::get()->toArray();
        //$goods = json_decode($goods);
        //dd($goods);
        return view('layouts/menu');
    }

}
