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
                <div class="cart-1">
                @foreach ($goods as $k=>$v)
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
                            <input value="{{$v['buy_number']}}" type="text" class="buy_number">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Price</h5>
                        </div>
                        <div class="col s7">
                            <h5>$<span id="subtotal">{{$v['subtotal']}}</span></h5>
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
                    @endforeach
                </div>
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
                        <h6 id="total">$40.00</h6>
                    </div>
                </div>
            </div>
            <button class="btn button-default">Process to Checkout</button>
        </div>
    </div>
    <!-- end cart -->

    <!-- loader -->
    <div id="fakeLoader"></div>
    <!-- end loader -->
    <script src="../../../index/js/jquery.min.js"></script>
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
             //countTotal();
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
            var goods_id='';
            var _box = $(".box");
            //var total = $("#total").html();
            _box.each(function(index){
                goods_id+=$(this).parents('div').attr('goods_id')+',';
                //alert(attr_id);
                });
            //alert(total);
           // goods_id=goods_id.substr(0,goods_id.length-1);
            //console.log(goods_id);return;
            $.post(
                "{{url('index/shop/getPriceInfo')}}",
                {goods_id:goods_id},
                function(res){
                    if(res.code==1){
                        $("#total").html('$'+res.price+'.00');
                    }
                },
                'json'
                );
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
    </script>

@endsection