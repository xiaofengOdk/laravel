  @extends('layout.shop');
  @section('title','顶级分类下的兄得们');
  @section('content'); 
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <form action="#" method="get" class="prosearch"><input type="text" /></form>
      </div>
     </header>
     <ul class="pro-select">
      <li class="pro-selCur"><a href="javascript:;">is_new</a></li>
      <li><a href="javascript:;">is_up</a></li>
      <li><a href="javascript:;">is_hot  </a></li>
     </ul><!--pro-select/-->
     <div class="prolist">
      @foreach($result as $k=>$v)
      <dl>
       <dt><a href="{{url('/proinfo/'.$v->goods_id)}}"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="{{url('/proinfo/'.$v->goods_id)}}">{{$v->goods_name}}</a></h3>
        <div class="prolist-price"><strong>¥{{$v->goods_price}}</strong> <span>¥{{$v->goods_price}}</span></div>
        <div class="prolist-yishou"><span>不打折</span> <em>库存：{{$v->goods_num}}</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
      @endforeach
     </div><!--prolist/-->
    @include('index.public.footer');
    @endsection;