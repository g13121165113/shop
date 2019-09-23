<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\User;
use DB;
use App\model\goods;
use App\model\Cart;

class userController extends Controller
{
    public function __construct()
    {
        $goods = goods::get()->toArray();
        $this->Middleware('center');
    }
    public function login()
    {
        $goods = Cart::get()->toArray();
        $data = request()->input('data');
        return view('index/user/login',compact('goods','data'));
    }
    public function dologin(Request $request)
    {
        $data=$request->input();
        $userInfo=User::where('user_name',$data['user_name'])->first();
        if($userInfo){
            if($userInfo->user_pwd==($data['user_pwd'])){
                $token = $this->getUserToken();
                $res = User::where('user_name',$data['user_name'])->update([
                    'user_token' =>$token,
                    'expire_time' => time() + 3600
                ]);
                if($res){
                    return json_encode(['code'=>6,'msg'=>'登陆成功','data'=>$token]);
                }
            }else{
                return json_encode(['code'=>5,'msg'=>'登陆失败']);
            }
        }
    }
    public function getUserInfo()
    {
        $token = request()->input('token');
        $userInfo =User::where('is_del',1)->where('user_token',$token)->first();
        if($userInfo){
            if(time()<$userInfo->expire_time){
                return json_encode(['code'=>6,'msg'=>'成功','data'=>$userInfo]);
            }else{
                return json_encode(['code'=>5,'msg'=>'token已过期']);
            }
        }else{
            return json_encode(['code'=>5,'msg'=>'用户不存在']);
        }
    }
    public function getUserToken()
    {
        $v = 1;
        $key = mt_rand();
        $hash = hash_hmac("sha1", $v . mt_rand() . time(), $key, true);
        $token = str_replace('=', '', strtr(base64_encode($hash), '+/', '-_'));
        return $token;
    }
}
