<?php

namespace App\Http\Controllers\index;

use App\model\goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\cates;
class GoodsController extends Controller
{
    public function index()
    {
        return  view('index/goods/index');
    }

    /**
     * 商品详情
     * @param Request $reques
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function goodsdetails(Request $reques)
    {
        $id = $reques->id;
        $res = goods::join('cates', 'goods.cate_id', '=', 'cates.cate_id')->where('goods_id',$id)->get();
//        dd($res);

        return  view('index/goods/goodsdetails',compact('res'));
    }
}
