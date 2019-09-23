<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Order;
use App\model\Cart;

class OrderController extends Controller
{
    public function index()
    {
        $user_id = \request()->input('user_id');
        if($user_id){
            $order = Order::where('user_id',$user_id)->get()->toArray();
            return view('index/order/index',['order'=>$order]);
        }else{
            echo "<script>alert('请先登录');location.href='/index/user/login'</script>";
        }
    }
    public function create()
    {
        $user_id = request()->input('user_id');
        $cart_id = request()->input('cart_id');
        $cart_id = explode(',',trim($cart_id,','));
        $price = request()->input('price');
        $order_sn = 'DD'.date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        $data['order_sn'] = $order_sn;
        $data['user_id'] = $user_id;
        $data['price'] = $price;
        $res = Order::insert($data);
        if($res){
            Cart::whereIn('cart_id',$cart_id)->update(['is_del'=>2]);
            $return = ['code'=>6,'msg'=>'成功','data'=>$order_sn];
            return json_encode($return);
        }
    }
}
