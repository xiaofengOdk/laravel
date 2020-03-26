   @extends('layout.shop');
   @section('title',"详情页");
   @section('content');
    <h1>访问了次了{{$count}}烦不烦</h1>
    <div class="maincont">
     <header>  
       @csrf
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header> 
      <div id="sliderA" class="slider">
        @php  $goods_res['goods_imgs']=explode('|',$goods_res['goods_imgs']);                  @endphp;  
        @foreach  ($goods_res['goods_imgs'] as $v)
     <img src="{{env('UPLOADS_URL')}}{{$v}}" />
        @endforeach
     </div><!--sliderA/-->
    <table class="jia-len">
      <tr>
       <th><strong class="orange">￥{{$goods_res->goods_price}}</strong></th>
       <td>
          <button class="decrease">-</button>
        <input type="text" id="numm"class="spinnerExample" />
        <button class="increase">+</button>
     
       
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$goods_res->goods_name}}</strong>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
        <li class="guigeCur"><a href="javascript:;">50ML</a></li>
        <li><a href="javascript:;">100ML</a></li>
        <li><a href="javascript:;">150ML</a></li>
        <li><a href="javascript:;">200ML</a></li>
        <li><a href="javascript:;">300ML</a></li>
        <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">库存</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="{{env('UPLOADS_URL')}}{{$goods_res->goods_img}}" width="636" height="822" />
     </div>
     <!--proinfoList/-->
     <div class="proinfoList">
        {{$goods_res->goods_desc}}
     </div><!--proinfoList/-->
     <div class="proinfoList">
      {{$goods_res->goods_num}}
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a href="javascript:;" class="zouqi">加入购物车</a></td>
      </tr>
     </table>
    </div>
    <script type="text/javascript">
    $(document).ready(function(){
     $(document).on("click",".increase",function(){
                // alert(1)
            var goods_num="{{$goods_res->goods_num}}"
            var goods_num=parseInt(goods_num)
                // alert(goods_num)
            var _val=$(".spinnerExample").val()
            // alert(_val)
            var _val=parseInt(_val)
            if(_val>=goods_num){
                $(".spinnerExample").val(goods_num)
            }else{
                _val=_val+1
               $(".spinnerExample").val(_val)
               }
                // console.log(_val)
            })       
       $('.spinnerExample').val(1)
       $(document).on('blur','.spinnerExample',function(){
          var _this=$(this)
          var reg=/^\d{1,}$/
          // var _this=parseInt(_this)
          var goods_num="{{$goods_res->goods_num}}"
          var goods_num=parseInt(goods_num)
          // alert(goods_num)
          if(_this==''){
            $('.spinnerExample').val(1)
          }else if(!reg.test(_this)){
            $('.spinnerExample').val(1)
          }else if(_this>=goods_num){
            $('.spinnerExample').val(goods_num)
          }else{
            $('.spinnerExample').val(parseInt(_this))          
          }
       })
       $(document).on('click','.decrease',function(){
          var _this=$(this)
           var _val=parseInt($(".spinnerExample").val())  
          // alert(_val)
         if(_val<=1){
            $(".spinnerExample").val(1)
           }else{
            _val=_val-1
            $(".spinnerExample").val(_val)       
     }
       })
        $(document).on('click','.zouqi',function(){
          // alert(_num)
            var num=  $('#numm').val()
            var goods_id="{{$goods_res->goods_id}}"
            var goods_img='{{$goods_res->goods_img}}';
            var goods_price="{{$goods_res->goods_price}}"
          $.get('/cart',{goods_id:goods_id,shop_num:num,goods_img:goods_img,goods_price:goods_price},function(res){
              // console.log(res)
          if(res.code=='0000'){
            alert(res.msg)
            location.href='/log?reget='+location.href;
          } 
           if(res.code=='00000'){
            alert(res.msg)
            location.href="{{url('/cartlist')}}"
          }            
       },'json')
        })

      })

    </script>
    @endsection;