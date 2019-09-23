@extends('layouts.index')

@section('title', 'shop')

@section('sidebar')
    <!-- login -->
    <div class="pages section">
        <div class="container">
            <div class="pages-head">
                <h3>LOGIN</h3>
            </div>
            <div class="login">
                <div class="row">
                    <form class="col s12">
                        <div class="input-field">
                            <input type="text" class="validate" placeholder="USERNAME" id="name" required>
                        </div>
                        <div class="input-field">
                            <input type="password" class="validate" placeholder="PASSWORD" id="pwd" required>
                        </div>
                        <a href=""><h6>Forgot Password ?</h6></a>
                        <a href="" id="userbtn" class="btn button-default">LOGIN</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end login -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script>
    $('#userbtn').click(function(){
        var name=$("#name").val();
        var pwd=$("#pwd").val();
        $.ajax({
            url:"{{url('index/user/dologin')}}",
            data:{user_name:name,user_pwd:pwd},
            type:'post',
            dataType:"json",
            success:function(res){
                    if(res.code == 6){
                        console.log(res.data);
                        $.ajax({
                            url:"{{url('index/user/userInfo')}}",
                            data:{token:res.data},
                            type:"post",
                            dataType:"json",
                            success:function (msg) {
                                console.log(msg);
                                if(msg.code==6){
                                    Cookies.set('userInfo',msg.data.user_id);
                                    location.href="../goods/index";
                                }
                            }
                        })
                    }
            }
        });
        return false;
    });
</script>
@endsection
