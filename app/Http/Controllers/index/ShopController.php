<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\goods;
class ShopController extends Controller
{
    public function index()
    {
        $goods = goods::get()->toArray();
        //$goods = json_decode($goods);
        //dd($goods);
        return view('index.shop.shop',compact('goods'));
    }
}
