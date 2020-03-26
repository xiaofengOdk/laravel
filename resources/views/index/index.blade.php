@extends('layout.shop');
   @section('title',"首页");
   @section('content');
    <div class="maincont">
     <div class="head-top">
      <img src="static/index/images/head.jpg" />
      <dl>
       <dt><a href="/"><img src="static/index/images/touxiang.jpg" /></a></dt>
       <dd>
        <ul>
         <li><a href="/"><strong>34</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     @php $admin=session('admin'); @endphp;
     @if($admin)
      <h1 align='center' style='background-color: red'>欢迎{{$admin->user_name}}登录</h1>
      <h4 align="center" style="background-color: yellow"><a href="{{url('/tuichu')}}">退出</a></h4>
      @else
 <ul class="reg-login-click">
      <li><a href="{{url('/log')}}">登录</a></li>
      <li><a href="{{url('/reg')}}" class="rlbg">注册</a></li>
      <div class="clearfix"></div>
     </ul>
     @endif
  <div id="sliderA" class="slider">   
        @foreach($new_res as $k=>$v)  
      <img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" />
     @endforeach
     </div><!--sliderA/-->
    <!-- //顶级分类 -->
     <ul class="pronav">
          @foreach($pid_res as $k=>$v)
      <li><a href="{{url('/pid/'.$v->cate_id)}}">{{$v->cate_name}}</a></li>
          @endforeach
      <div class="clearfix"></div>
     </ul><!--pronav/-->
              @foreach($up_res as $k=>$v)
  <div class="index-pro1">
   <div class="index-pro1-list">
       <dl>
        <dt><a href="{{url('/proinfo/'.$v->goods_id)}}"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" /></a></dt>
        <dd class="ip-text"><a href="{{url('/'.$v->goods_id)}}">{{$v->goods_name}}</a><span>${{$v->goods_price}}</span></dd>
       </dl>
      </div>
              @endforeach
  <div class="clearfix"></div>
     </div><!--index-pro1/-->
      @foreach($hot_res  as $k=>$v)
     <div class="prolist">
      <dl>
       <dt><a href="{{url('/proinfo/'.$v->goods_id)}}">
        <img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="{{url('/proinfo/'.$v->goods_id)}}">{{$v->goods_name}}</a></h3>
        <div class="prolist-price"><strong>¥{{$v->goods_price}}</strong> <span>¥{{$v->goods_price}}</span></div>
        <div class="prolist-yishou"><span>不打折</span></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div>
      @endforeach
     <!--prolist/-->
  

    </div><!--maincont-->
     @include('index.public.footer');
     @endsection