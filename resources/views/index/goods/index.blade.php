@extends('layouts.index')

@section('title', 'shop')

@section('sidebar')

    <div class="slider">

        <ul class="slides">
            <li>
                <img src="img/slide1.jpg" alt="">
                <div class="caption slider-content  center-align">
                    <h2>WELCOME TO MSTORE</h2>
                    <h4>Lorem ipsum dolor sit amet.</h4>
                    <a href="" class="btn button-default">SHOP NOW</a>
                </div>
            </li>
            <li>
                <img src="img/slide2.jpg" alt="">
                <div class="caption slider-content center-align">
                    <h2>JACKETS BUSINESS</h2>
                    <h4>Lorem ipsum dolor sit amet.</h4>
                    <a href="" class="btn button-default">SHOP NOW</a>
                </div>
            </li>
            <li>
                <img src="img/slide3.jpg" alt="">
                <div class="caption slider-content center-align">
                    <h2>FASHION SHOP</h2>
                    <h4>Lorem ipsum dolor sit amet.</h4>
                    <a href="" class="btn button-default">SHOP NOW</a>
                </div>
            </li>
        </ul>

    </div>
    <!-- end slider -->

    <!-- features -->
    <div class="features section">
        <div class="container">
            <div class="row">
                <div class="col s6">
                    <div class="content">
                        <div class="icon">
                            <i class="fa fa-car"></i>
                        </div>
                        <h6>Free Shipping</h6>
                        <p>Lorem ipsum dolor sit amet consectetur</p>
                    </div>
                </div>
                <div class="col s6">
                    <div class="content">
                        <div class="icon">
                            <i class="fa fa-dollar"></i>
                        </div>
                        <h6>Money Back</h6>
                        <p>Lorem ipsum dolor sit amet consectetur</p>
                    </div>
                </div>
            </div>
            <div class="row margin-bottom-0">
                <div class="col s6">
                    <div class="content">
                        <div class="icon">
                            <i class="fa fa-lock"></i>
                        </div>
                        <h6>Secure Payment</h6>
                        <p>Lorem ipsum dolor sit amet consectetur</p>
                    </div>
                </div>
                <div class="col s6">
                    <div class="content">
                        <div class="icon">
                            <i class="fa fa-support"></i>
                        </div>
                        <h6>24/7 Support</h6>
                        <p>Lorem ipsum dolor sit amet consectetur</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end features -->

    <!-- quote -->
    <div class="section quote">
        <div class="container">
            <h4>FASHION UP TO 50% OFF</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid ducimus illo hic iure eveniet</p>
        </div>
    </div>
    <!-- end quote -->

    <!-- product -->
    <div class="section product">
        <div class="container">
            <div class="section-head">
                <h4>NEW PRODUCT</h4>
                <div class="divider-top"></div>
                <div class="divider-bottom"></div>
            </div>
            <div class="row">
                <div class="col s6">
                    <div class="content">
                        <img src="img/product-new1.png" alt="">
                        <h6><a href="">Fashion Men's</a></h6>
                        <div class="price">
                            $20 <span>$28</span>
                        </div>
                        <button class="btn button-default">ADD TO CART</button>
                    </div>
                </div>
                <div class="col s6">
                    <div class="content">
                        <img src="img/product-new2.png" alt="">
                        <h6><a href="">Fashion Men's</a></h6>
                        <div class="price">
                            $20 <span>$28</span>
                        </div>
                        <button class="btn button-default">ADD TO CART</button>
                    </div>
                </div>
            </div>
            <div class="row margin-bottom">
                <div class="col s6">
                    <div class="content">
                        <img src="img/product-new3.png" alt="">
                        <h6><a href="">Fashion Men's</a></h6>
                        <div class="price">
                            $20 <span>$28</span>
                        </div>
                        <button class="btn button-default">ADD TO CART</button>
                    </div>
                </div>
                <div class="col s6">
                    <div class="content">
                        <img src="img/product-new4.png" alt="">
                        <h6><a href="">Fashion Men's</a></h6>
                        <div class="price">
                            $20 <span>$28</span>
                        </div>
                        <button class="btn button-default">ADD TO CART</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end product -->

    <!-- promo -->
    <div class="promo section">
        <div class="container">
            <div class="content">
                <h4>PRODUCT BUNDLE</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                <button class="btn button-default">SHOP NOW</button>
            </div>
        </div>
    </div>
    <!-- end promo -->

    <!-- product -->
    <div class="section product">
        <div class="container">
            <div class="section-head">
                <h4>TOP PRODUCT</h4>
                <div class="divider-top"></div>
                <div class="divider-bottom"></div>
            </div>
            <div id="row" class="row">

            </div>
            <div class="row">

            </div>
            <div class="pagination-product">
                <ul>
                    <li class="active">1</li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li>
                    <li><a href="">4</a></li>
                    <li><a href="">5</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end product -->

    <!-- loader -->
    <div id="fakeLoader"></div>
    <!-- end loader -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script>
        $.ajax({
            url:"/index/goods/select",
            type:'post',
            dataType:'json',
            success:function(res){
                console.log(res)
                if(res.code == 6){
                    $.each(res.data,function(i,v){
                        var div = '<div class="content">\n' +
                            '                        <img src='+v.goods_img+' alt="">\n' +
                            '                        <h6><a href="">'+v.goods_name+'</a></h6>\n' +
                            '                        <div class="price">'+v.goods_price+'</div>\n' +
                            '                        <button class="btn button-default cartbtn" buy_price='+v.goods_price+' goods_id='+v.goods_id+'>加入购物车</button>\n' +
                            '                    </div>';
                        $('#row').append(div);
                    })
                }
            }
        })
        $(document).on('click','.btn',function(){
            var goods_id = $(this).attr('goods_id');
            var user_id = Cookies.get('userInfo');
            var buy_price = $(this).attr('buy_price');
            $.ajax({
                url:"/index/cart/create",
                data:{goods_id:goods_id,user_id:user_id,buy_price:buy_price},
                type:"post",
                dataType:"json",
                success:function(res){
                    if(res.code == 6){
                        alert(res.msg);
                        location.href="/index/cart/index";
                    }
                }
            })
        })
    </script>
@endsection
