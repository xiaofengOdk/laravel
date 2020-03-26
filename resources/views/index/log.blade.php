@extends('layout.shop');
@section('title',"登录");
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
     <form action="{{url('/login/logdo')}}" method="post" class="reg-login">
      @csrf
      <h3>还没有三级分销账号？点此<a class="orange" href="{{url('/reg')}}">注册</a></h3>
      <div class="lrBox">
      {{session('msg')}}
      <input type="hidden" name="reget" value="{{$reget}}">
     <div class="lrList"><input type="text" name="admin_name" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList"><input type="password" name="admin_pwd"placeholder="输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即登录" />
      </div>
       <div class="lrSub">
       <input type="checkbox"  name="remeber"value="七天免登录" />
      </div>
     </form><!--reg-login/-->
   @include('index.public.footer');     
   @endsection