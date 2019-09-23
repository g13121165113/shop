@extends('layouts.index')

@section('title', 'shop')

@section('sidebar')

    <!-- cart -->
    <div class="cart section">
        <div class="container">
            <div class="pages-head">
                <h3>CART</h3>
            </div>
            <div class="content">
                @foreach ($goods as $k=>$v)
                    <div class="cart-1 cartid" cart_id="{{$v['cart_id']}}" >
                    <div class="row">
                        <div class="col s5" goods_id = "{{$v['goods_id']}}">
                            <h5><input type="hidden" class="box"/>Image</h5>
                        </div>
                        <div class="col s7">
                            <img src="{{$v['goods_img']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Name</h5>
                        </div>
                        <div class="col s7">
                            <h5><a href="">{{$v['goods_name']}}</a></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Quantity</h5>
                        </div>
                        <div class="col s7" goods_id = "{{$v['goods_id']}}" goods_number= "{{$v['goods_num']}}" >
                            <input value="{{$v['buy_num']}}" type="text" goods_price="{{$v['goods_price']}}" class="buy_number">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Price</h5>
                        </div>
                        <div class="col s7">
                            <h5>$<span class="subtotal">{{$v['subtotal']}}</span></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Action</h5>
                        </div>
                        <div class="col s7" goods_id = "{{$v['goods_id']}}">
                            <h5><i class="fa fa-trash" id="delete"></i></h5>
                        </div>
                    </div>
                    <div class="divider"></div>
                    </div>
                @endforeach
            </div>
            <div class="total">
            @foreach ($goods as $k=>$v)
                <div class="row">
                    <div class="col s7">
                        <h5>{{$v['goods_name']}}</h5>
                    </div>
                    <div class="col s5">
                        <h5>${{$v['subtotal']}}</h5>
                    </div>
                </div>
            @endforeach
                <div class="row">
                    <div class="col s7">
                        <h6>Total</h6>
                    </div>
                    <div class="col s5">
                        <h6 >$<span id="price"></span></h6>
                    </div>
                </div>
            </div>
            <button class="btn button-default" id="btn">Process to Checkout</button>
        </div>
    </div>
    <!-- end cart -->

    <!-- loader -->
    <div id="fakeLoader"></div>
    <!-- end loader -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script type="text/javascript">
        //购买数量失去焦点
        $(document).on("blur",'.buy_number',function(){
            var _this=$(this);
            //改变购买数量
            var buy_number=_this.val();
            var goods_number=_this.parents("div").attr("goods_number");
            // console.log(buy_number);
            // console.log(goods_number);
            // return;
            //验证
            var reg=/^\d{1,}$/;
            if(buy_number=='' || buy_number<=1 || !reg.test(buy_number)){
                _this.val(1);
            }else if(parseInt(buy_number)>=parseInt(goods_number)){
                _this.val(goods_number);
            }else{
            _this.val(parseInt(buy_number));
             }
             //控制器改变购买数量
            var goods_id=_this.parents('div').attr('goods_id');
            changeBuyNumber(goods_id,buy_number);

            //改变小计
            getSubTotal(goods_id,_this);

            // //改变商品总价
            //  countTotal();
        })

        // 更改购买数量
        function changeBuyNumber(goods_id,buy_number){
            // 同步
            $.ajax({
                  url: "{{url('index/shop/changeBuyNumber')}}",
                  method: "POST",
                  data: {goods_id:goods_id,buy_number:buy_number},
                  async: false,
                success:function( res ) {
                    //错误给出提示 正确不提示

                }
            });
        }

        //获取小计
        function getSubTotal(goods_id,_this){
            $.post(
                "{{url('index/shop/getSubTotal')}}",
                {goods_id:goods_id},
                function(res){
                    if(res.code==3){
                        history.go(0);
                    }

                },
                'json'
                );
        }

        //获取商品总价
        var price = 0;
        $('.subtotal').each(function(){
            price += parseInt($(this).text());
        })
        $("#price").html(price);
        //删除
        $(document).on("click",'#delete',function(){
            var goods_id = $(this).parents('div').attr('goods_id');
            $.ajax({
                url:"{{url('index/shop/delete')}}",
                type:"POST",
                data:{goods_id:goods_id},
                dataType:"json",
                success:function(res){
                    if(res.code==5){
                        history.go(0);
                    }
                }
            })

        });
        $("#btn").click(function(){
            var user_id = Cookies.get('userInfo');
            var buy_price = $('#price').text();
            var cart_id='';
            var cart = $(".cartid");
            cart.each(function(){
                cart_id+=$(this).attr('cart_id')+',';
            });
            $.ajax({
                url:'/index/order/create',
                data:{user_id:user_id,price:buy_price,cart_id:cart_id},
                type:"post",
                dataType:"json",
                success:function(msg){
                    var order_num = msg.data;
                    location.href="/alipay?order_num="+order_num;
                }
            })
        })
    </script>

@endsection
