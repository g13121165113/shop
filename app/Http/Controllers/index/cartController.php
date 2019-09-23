<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Cart;
use App\model\User;
use App\model\goods;

class cartController extends Controller
{
    public function __construct()
    {
        $goods = goods::get()->toArray();
        $this->Middleware('center');
    }
    public function select(Request $request)
    {
        $user_id = request()->get('user_id')??1;
        $result=Cart::join('goods','cart.goods_id','=','goods.goods_id')
            ->where('cart.is_del',1)
            ->where('cart.user_id',$user_id)
            ->get()
            ->toArray();
        $data = request()->get('data');
        return view('index/cart/index',['goods'=>$result,'data'=>$data]);
    }
    public function create(Request $request)
    {
        $goods_id = request()->input('goods_id');
        $buy_price = request()->input('buy_price');
        $user_id = request()->get('user_id');
        if($user_id){
            $result=Cart::where('goods_id',$goods_id)->where('is_del',1)->where('user_id',$user_id)->first();
            $goods = goods::where('goods_id',$goods_id)->where('is_del',1)->first();
            if($result){
                $buy_num=$result->buy_num+1;
                $res=Cart::where('cart_id',$result->cart_id)->update(['buy_num'=>$buy_num]);
                $data = ['data'=>$res,'msg'=>'添加成功','code'=>6];
                return json_encode($data);
            }else{
                $res=Cart::insert(['goods_id'=>$goods_id,'buy_price'=>$buy_price,'user_id'=>$user_id]);
                $data = ['data'=>$res,'msg'=>'添加成功','code'=>6];
                return json_encode($data);
            }
        }else{
            $data = ['msg'=>'请先登录','code'=>5];
            return json_encode($data);
        }
    }

}
