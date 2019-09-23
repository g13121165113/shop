<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\cates;
use App\model\center;
use DB;
use App\model\goods;
use App\model\Cart;

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
        $goods = Cart::join("goods","cart.goods_id","=","goods.goods_id")->get()->toArray();
        return  view('index/goods/index',['data'=>$data,'goods'=>$goods]);
    }

    public function select()
    {
        $goods = goods::where('is_del',1)->get()->toArray();
        $return = ['code'=>6,'msg'=>'查询成功','data'=>$goods];
        return json_encode($return);
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
        $goods = goods::get()->toArray();
        return  view('index/goods/goodsdetails',compact('res','goods'));
    }

}
