<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\goods;
use App\model\shop;
class ShopController extends Controller
{
    public function index()
    {
        //$goods = goods::get()->toArray();
        //$goods = json_decode($goods);
        //dd($goods);
        $goods = shop::join("goods","shop.goods_id","=","goods.goods_id")->get()->toArray();
        //dd($goods);
        return view('index.shop.shop',compact('goods'));
    }

    public function getPriceInfo()
    {
        $goods_id = request()->input('goods_id');
        //dd($goods_id);
        $goods_id = rtrim($goods_id,',');


        $res = shop::whereIn('goods_id',explode(',',$goods_id))->get()->toArray();
        $where=[];
        foreach($res as $k=>$v){
            //dd($v);
            $where[] = $v['subtotal'];

        }
        $price = array_sum($where);
        return json_encode(['code'=>1,'msg'=>'修改总价成功','price'=>$price]);
    }

    public function changeBuyNumber()
    {
        $goods_id = request()->goods_id;
        $buy_number = request()->buy_number;
        // var_dump($buy_number);
        // dd($goods_id);
        $shop = shop::where('goods_id',$goods_id)->get()->toArray();
        $number = $buy_number-$shop[0]['buy_number'];
        shop::where('goods_id',$goods_id)->update(['buy_number'=>$buy_number]);
        $goods = goods::where('goods_id',$goods_id)->get()->toArray();
        $goods_num = $goods[0]['goods_num']-$number;
        goods::where('goods_id',$goods_id)->update(['goods_num'=>$goods_num]);
        return json_encode(['code'=>2,'msg'=>'成功']);
        //dd($number);
    }

    public function getSubTotal()
    {
        $goods_id = request()->goods_id;
        $goods = shop::join("goods","shop.goods_id","=","goods.goods_id")->where('shop.goods_id',$goods_id)->get()->toArray();
        //dd($goods);
        $subtotal = $goods[0]['buy_number']*$goods[0]['goods_price'];
        shop::where('goods_id',$goods_id)->update(['subtotal'=>$subtotal]);
        return json_encode(['code'=>3,'msg'=>'小计修改成功']);
    }

    public function delete()
    {
        $goods_id = request()->goods_id;
        //dd($goods_id);
        $delete = shop::where('goods_id',$goods_id)->delete();
        return json_encode(['code'=>5,'msg'=>'删除成功']);
    }
}
