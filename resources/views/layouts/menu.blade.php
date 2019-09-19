<div class="menus" id="animatedModal">
        <div class="close-animatedModal close-icon">
            <i class="fa fa-close"></i>
        </div>
        <div class="modal-content">
            <div class="cart-menu">
                <div class="container">
                    <div class="content">
                        <div class="cart-1">
                        @foreach ($goods as $k=>$v)
                            <div class="row">
                                <div class="col s5">
                                    <img src="{{$v['goods_img']}}" alt="">
                                </div>
                                <div class="col s7">
                                    <h5><a href="">{{$v['goods_name']}}</a></h5>
                                </div>
                            </div>
                            <div class="row quantity">
                                <div class="col s5">
                                    <h5>Quantity</h5>
                                </div>
                                <div class="col s7">
                                    <input value="1" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s5">
                                    <h5>Price</h5>
                                </div>
                                <div class="col s7">
                                    <h5>${{$v['goods_price']}}</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s5">
                                    <h5>Action</h5>
                                </div>
                                <div class="col s7">
                                    <div class="action"><i class="fa fa-trash"></i></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="divider"></div>

                    </div>
                    <div class="total">
                        @foreach ($goods as $k=>$v)
                            <div class="row">
                                <div class="col s7">
                                    <h5>{{$v['goods_name']}}</h5>
                                </div>
                                <div class="col s5">
                                    <h5>${{$v['goods_price']}}</h5>
                                </div>
                            </div>
                        @endforeach
                        <div class="row">
                            <div class="col s7">
                                <h6>Total</h6>
                            </div>
                            <div class="col s5">
                                <h6>$41.00</h6>
                            </div>
                        </div>
                    </div>
                    <button class="btn button-default">Process to Checkout</button>
                </div>
            </div>
        </div>
</div>