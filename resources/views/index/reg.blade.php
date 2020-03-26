@extends('layout.shop');
@section('title','注册');
@section('content');
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('/login/regdo')}}" method="post" class="reg-login">
      @csrf
     {{session('msg')}} <h3>已经有账号了？点此<a class="orange" href="{{url('/log')}}">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" class="name" name='user_name'placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2"><input type="text"  name="user_code"placeholder="输入短信验证码" />
        <button class="_but" type="button">获取验证码</button>
      </div>
       <div class="lrList"><input type="text"name="user_pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="text" name="repwd"placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     @include('index.public.footer');
      <script type="text/javascript">
        $(document).ready(function(){
          $(document).on("click",'._but',function(){
            // alert(1)
             var name= $('input[name="user_name"]').val()
            // alert(name)
            var reg=/^1[3|5|6|7|8]\d{9}$/
            if(reg.test(name)){
              $.get("/reg/send",{name:name},function(res){
                  // alert(res)
                  if(res.code=='000000'){
                    alert(res.ooo)
                  }
               },'json') 
              
            }
            var emailreg=/^[a-zA-Z0-9]{6,}@qq\.com$/
          if(emailreg.test(name)){
             // alert(123)
              $.get('/sendemail',{name:name},function(res){
                // console.log(res);
                // if(res.code=='00000'){}
              })
          }else{
              alert('格式不正确');
              return false;
          }
          })
        })
      </script>
     @endsection