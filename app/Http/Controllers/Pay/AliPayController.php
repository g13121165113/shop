<?php

namespace App\Http\Controllers\Pay;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Order;

class AliPayController extends Controller
{
    public $app_id;
    public $gate_way;
    public $notify_url;
    public $return_url;
    public $rsaPrivateKeyFilePath = '';
    public $aliPubKey = '';
    public $privateKey = 'MIIEowIBAAKCAQEAu0Eiy+9d1/SPm25LmaoYOl7sJMtmWsdReW1Ll3NGyBjC0nbJ+B5ycC9tZ35OLT5n+UHMgYN3mgCWVOqiWuOahtXQlA48hjtEtdhcWJKTUP4v2JHv0c278Xeikq/IAkW2QLQs43HVbAJY5DyhOhXO+YBIlkvz2F69m89If6kR2DcT7TGAbKr5x9XeYtAV9Fd23ttUR44qUh2chpiuWVW70QSK6BiWZWLQQSOFRlyW6+LtR3T/VEKkjpQHPGMHrOfSNbPL29MYeOIHQMn+n3SD1/DSsL6Yg3VkZyWOcJEyXU0Rw7gunecQtBa86tWo9coaVyCq2JTAqonIPIeIZ154uwIDAQABAoIBAGeLzUIYSzxv8Dly9Ds049DjTJHMJ/1q2pLa7UICbNGZX6IiLe0WaRHAKC9imLhMGhKrX/r+R9TRHlA2rzCzS2/kLEKy3KUdgRFNY0NXSj8vUCXiDUtnCNat4ShcK62V/wIon+nluK7RXXZYUI9eH+W4GmuB9IVhXlgad2yggU2ds+Mye3dIbODDMfIScOb48+nMjh7CvjPzN+rZQik1MDzN9jaUHcaW99vmskjsBFHi2FZI4G2Px5M10E8cxjCrysIgosCs4rRW1gs7UMkGQUiqIo9RH2xvElgfoWZdmaVF0+b7MOOzXztl2IXDGMtrdS/RfunKSuA8OOlxNavDOwECgYEA8uwBPPEytmf9Wv1nVbo4nzuR8isZIqZdiH+6NllV0nUU5ZDo3jQH55ohce8yJA3sJJ/apZDbjv+Gf2/dv4eW8oxGGRhGsus7GSjzs5JVD+o22S0t/HyYJqVC8ipWrcDGnp/jH5vT5MuNh31BxaoA++/g+aIi8ZMXvOmaJRvNDDMCgYEAxVXpaCVuSaOL+gjPsetizlm0XH43kPK4Mhrdst5EOXqxAlPV8oz7+rdLNw8RfWSjaaZZ4R7zbJD+ImGeybCMPmQQazXRiy6IAEaBqoav8CZiTTK5/DpNB+gvvR8+BY1FSHB4GNlbJbNg8cHsvDM6tDGgyf+QEQX9VqvOT/1K2VkCgYBksr5ko9uQz5SvxkGywMo9/7SlPYZi3bICJmhrpSa1YkFyVFqj2c+5CyR4FV6koXzVRcqePWk2Yug/JYE3px5Ely9rsauE+Yv7BwXW138ZZM6twlPAyWlNA863kiNyTWpIUSEWdkMlIdgeZScBqFJWHX8WHEb9+yqo7fEvFtIuDwKBgE7YMabb9cHUZ5QiOyHiY5sA+nBOOdNfNztFwri519aDb//3ES+VJwSYgaPhEGLid+w5fAXXgPkqwW9pQ7FgKdiv0GOVoECU+d/qS9qfb+Jq47Hmh6sAfFChc5mDxxsew8TasxFyntlkX2KY0gasDVN71LuAscYrd3pOsOMC2AoZAoGBAOBVvOTYSa9t43Y3pQEevOqM0pZyCAHa+Go5mQyQlRIQ1dqcxmK3oE0c1Y4Rgvm6EtRJYCHSr5CYnsioaCct+M8jEzRC/GLh6QU/dbXZeu3rKgTqaAQuJ67pqHU09oOebtDEbENOOMhxsj3rSy1Tlb3kdS133wtHSzOw1UD6bCvi';
    public $publicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAm5kw4eTAhVGlDOMvj6e9o+DSzBmSINYMebDJ8vgjz7GKep5Y0b6bCTqr20CXLaETxmYpR2gKqM9pAp8cYlTxSQxLLsaO1F892V9GNcttNHZZdzPpWKWoSqcQEvUhhgxP15JnCAs9+SU3es4t9ZcO7LM/Iu+A5KpPKnBVgTR5DyrF+EljHiAG5RF0YyQaecDhzLfuoYXb3d9v9UwF3u15ldWgspM3ZKpLYilVViZYuvJoY/ocbh2FRLNVgaxI/SnBF/5d75AwInhLajubusiPuTlYb3742aGO/XRdC4geqmU1YmBlnxt+UXUrlbFqVv40hDLljhHPVGrtDv4WH0xEMQIDAQAB';
    public function __construct()
    {
        $this->app_id = '2016092700605369';
        $this->gate_way = 'https://openapi.alipaydev.com/gateway.do';
        $this->notify_url = env('APP_URL').'/notify_url';
        $this->return_url = env('APP_URL').'/return_url';
    }


    /**
     * 订单支付
     * @param $oid
     */
    public function pay(Request $request)
    {
        $order_num=$request->input('order_num');
        $orderInfo=Order::where('order_sn',$order_num)->where('is_del',1)->first();
    	file_put_contents(storage_path('logs/alipay.log'),$order_num,FILE_APPEND);
    	// die();
        //判断订单是否已被支付
        if($orderInfo->order_status==2){
            die("订单已支付，请勿重复支付");
        }
        //判断订单是否已被删除
        if($orderInfo->is_del==2){
            die("订单已被删除，无法支付");
        }
        // $oid = time().mt_rand(1000,1111);

        // dd($orderInfo);
        //业务参数
        $bizcont = [
            'subject'           => '并夕夕: ' .$orderInfo->order_sn,
            'out_trade_no'      => $orderInfo->order_sn,
            'total_amount'      => $orderInfo->price,
            'product_code'      => 'FAST_INSTANT_TRADE_PAY',
        ];
        // dd($bizcont);
        //公共参数
        $data = [
            'app_id'   => $this->app_id,
            'method'   => 'alipay.trade.page.pay',
            'format'   => 'JSON',
            'charset'   => 'utf-8',
            'sign_type'   => 'RSA2',
            'timestamp'   => date('Y-m-d H:i:s'),
            'version'   => '1.0',
            'notify_url'   => $this->notify_url,        //异步通知地址
            'return_url'   => $this->return_url,        // 同步通知地址
            'biz_content'   => json_encode($bizcont),
        ];
        //签名
        $sign = $this->rsaSign($data);
        $data['sign'] = $sign;
        $param_str = '?';
        foreach($data as $k=>$v){
            $param_str .= $k.'='.urlencode($v) . '&';
        }
        $url = rtrim($param_str,'&');
        $url = $this->gate_way . $url;

        header("Location:".$url);
    }
    public function rsaSign($params) {
        return $this->sign($this->getSignContent($params));
    }
    protected function sign($data) {
    	if($this->checkEmpty($this->rsaPrivateKeyFilePath)){
    		$priKey=$this->privateKey;
			$res = "-----BEGIN RSA PRIVATE KEY-----\n" .
				wordwrap($priKey, 64, "\n", true) .
				"\n-----END RSA PRIVATE KEY-----";
    	}else{
    		$priKey = file_get_contents($this->rsaPrivateKeyFilePath);
        $res = openssl_get_privatekey($priKey);
    	}

        ($res) or die('您使用的私钥格式错误，请检查RSA私钥配置');
        openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        if(!$this->checkEmpty($this->rsaPrivateKeyFilePath)){
            openssl_free_key($res);
        }
        $sign = base64_encode($sign);
        return $sign;
    }
    public function getSignContent($params) {
        ksort($params);
        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
            if (false === $this->checkEmpty($v) && "@" != substr($v, 0, 1)) {
                // 转换成目标字符集
                $v = $this->characet($v, 'UTF-8');
                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "=" . "$v";
                } else {
                    $stringToBeSigned .= "&" . "$k" . "=" . "$v";
                }
                $i++;
            }
        }
        unset ($k, $v);
        return $stringToBeSigned;
    }
    protected function checkEmpty($value) {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }
    /**
     * 转换字符集编码
     * @param $data
     * @param $targetCharset
     * @return string
     */
    function characet($data, $targetCharset) {
        if (!empty($data)) {
            $fileType = 'UTF-8';
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
            }
        }
        return $data;
    }
    /**
     * 支付宝同步通知回调
     */
    public function aliReturn()
    {
        header('Refresh:2;url=/index_order3');
        echo "订单： ".$_GET['out_trade_no'] . ' 支付成功，正在跳转';
    }
    /**
     * 支付宝异步通知
     */
    public function aliNotify()
    {
        $data = json_encode($_POST);
        $log_str = '>>>> '.date('Y-m-d H:i:s') . $data . "<<<<\n\n";
        //记录日志
        file_put_contents('../storage/logs/alipay.log',$_POST,FILE_APPEND);
        //验签
        // dd($data);
        $res = $this->verify($_POST);
        $log_str = '>>>> ' . date('Y-m-d H:i:s');
        if($res === false){
            //记录日志 验签失败
            $log_str .= " Sign Failed!<<<<< \n\n";
            file_put_contents('logs/alipay.log',$log_str,FILE_APPEND);
        }else{
            $log_str .= " Sign OK!<<<<< \n\n";
            file_put_contents('logs/alipay.log',$log_str,FILE_APPEND);
        }
        //验证订单交易状态
        if($_POST['trade_status']=='TRADE_SUCCESS'){
            //更新订单状态
            $oid = $_POST['out_trade_no'];     //商户订单号
            $info = [
                'is_pay'        => 1,       //支付状态  0未支付 1已支付
                'pay_amount'    => $_POST['total_amount'] * 100,    //支付金额
                'pay_time'      => strtotime($_POST['gmt_payment']), //支付时间
                'plat_oid'      => $_POST['trade_no'],      //支付宝订单号
                'plat'          => 1,      //平台编号 1支付宝 2微信
            ];
            OrderModel::where(['oid'=>$oid])->update($info);
        }
        //处理订单逻辑
        $this->dealOrder($_POST);
        echo 'success';
    }
    //验签
    function verify($params) {
        // dd($params);
        $sign = $params['sign'];
        $params['sign_type'] = null;
        $params['sign'] = null;
        //读取公钥文件
        $pubKey = file_get_contents($this->aliPubKey);
        $pubKey = "-----BEGIN PUBLIC KEY-----\n" .
            wordwrap($pubKey, 64, "\n", true) .
            "\n-----END PUBLIC KEY-----";
        //转换为openssl格式密钥
        $res = openssl_get_publickey($pubKey);
        ($res) or die('支付宝RSA公钥错误。请检查公钥文件格式是否正确');
        //调用openssl内置方法验签，返回bool值
        $result = (openssl_verify($this->getSignContent($params), base64_decode($sign), $res, OPENSSL_ALGO_SHA256)===1);
        openssl_free_key($res);
        return $result;
    }
    /**
     * 处理订单逻辑 更新订单 支付状态 更新订单支付金额 支付时间
     * @param $data
     */
    public function dealOrder($data)
    {
        //加积分
        // dd($data);
        // DB::beginTransaction();
        // try{
        //     if (!$result1) {
        //         /**
        //          * Exception类接收的参数
        //          * $message = "", $code = 0, Exception $previous = null
        //          */
        //         throw new \Exception("1");
        //     }
        //     $result2 = Test::create(['name'=>$name]);
        //     if (!$result2) {
        //         throw new \Exception("2");
        //     }
        //     DB::commit();
        // } catch (\Exception $e){
        //     DB::rollback();//事务回滚
        //     echo $e->getMessage();
        //     echo $e->getCode();
        // }
    }
}
