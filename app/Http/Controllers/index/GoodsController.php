<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\cates;
use App\model\center;
use DB;

class GoodsController extends Controller
{
    public function __construct()
    {
        $goods = goods::get()->toArray();
        $this->Middleware('center');
    }

    public function index()
    {
    	// $data = center::where(['id'=>$id])->first();
        $data = request()->get('data');
        $goods = Goods::where('is_del',1)->get()->toArray();
        return  view('index/goods/index',['data'=>$data,'goods'=>$goods]);
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
        $goods = goods::get()->toArray();
        return  view('index/goods/goodsdetails',compact('res','goods'));
    }

}
