  @extends('layout.shop');
@section('title','购物车');
@section('content');
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$res}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     <div class="dingdanlist">
      <table>
       <tr >
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" class="allbox" /> 全选</a></td>
       </tr>   
        @foreach($cart_res as $k=>$v)

       <tr goods_id="{{$v->goods_id}}">
        <td width="4%"><input type="checkbox" class="box" /></td>
        <td class="dingimg" width="15%"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>名称::{{$v->goods_name}}</h3>
         <time>添加到购物车的时间::{{date("Y-m-d H:i:s",$v->time)}}</time>
        </td>
        <td align="right" goods_num="{{$v->goods_num}}">
            <button class="decreasesss">-</button>
            <input type="text"  value="{{$v->shop_num}}
"class="spinnerExample" />    
            <button class="increase">+</button>
        </td>
       </tr>
       
       <tr>
        <th colspan="4"><strong class="orange">¥{{$v->goods_price*$v->shop_num}}</strong></th>
       </tr>  
          @endforeach

         <tr>
        <td width="100%" colspan="4"><a href="javascript:;"class='dels' > 删除</a></td>
       </tr>
      </table>
     </div><!--dingdanlist/-->
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange" id="totall">¥</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   <script type="text/javascript">
     $(document).ready(function(){
        // $('.spinnerExample').val(1)
        //加号
      $(document).on('click','.increase',function(){
          var _this=$(this)
          var goods_num=_this.parent().attr('goods_num')
          // alert(goods_num)
          var goods_num=parseInt(goods_num)
          // alert(goods_num)
          var _num=parseInt(_this.prev('input').val())
          // alert(_num)
          if(_num>=goods_num){
              _this.prev('input').val(goods_num)
              _num=goods_num
          }else{
              _num=_num+1
              _this.prev('input').val(_num)
          }
          var goods_id=_this.parents('tr').attr('goods_id')
          // alert(goods_id)
          getRxiaoji(goods_id,_this)
          getChecked(_this)
          getNewxiaoji(goods_id,_num)
          getTotall()  
      })
            $(document).on("click",".box",function(){
                var _this=$(this)
                 var status=_this.prop("checked")
          getTotall()  
  })
      function getTotall(){   
           var _val=$(".box:checked")
           var good_id=''
           _val.each(function(){
                good_id+= $(this).parents("tr").attr("goods_id")+","
            })
            // alert(good_id)    
             good_id=good_id.substr(0,good_id.length-1);        
            // alert(good_id)
            $.get('/getTotall',{good_id:good_id},function(res){
               // alert(res)
                $('#totall').text(res)
            })
      }
      //全选
      $(document).on('click','.allbox',function(){
             var _this=$(this)           
             var status=$(".allbox").prop("checked")
             $(".box").prop("checked",status)
            getTotall()  

      })
      function getRxiaoji(goods_id,_this){
      $.get('/getRxiaoji',{goods_id:goods_id},function(res){
            // alert(res)
            if(res){
                _this.parents("tr").next("tr").text("￥"+res)
            }
          })

      }
      function getChecked(_this){
          _this.parents("tr").find(".box").prop("checked",true)        
      } 
      //减号
      $(document).on('click','.decreasesss',function(){
               // alert(1)
        var _this=$(this)
        var goods_id=_this.parents('tr').attr('goods_id')
        var goods_num=parseInt(_this.next('input').val());
        if(goods_num<=1){
            _this.next('input').val(1)
        }else{
          goods_num=goods_num-1
          _this.next('input').val(goods_num)
        }
          getRxiaoji(goods_id,_this)
          getChecked(_this)
          getNewxiaoji(goods_id,goods_num)
          getTotall()  
      })
      function getNewxiaoji(goods_id,_num){
          $.get('/rexiaoji',{goods_id:goods_id,_num:_num},function(res){
            // alert(res)
           if(res.code=='000'){
                  // alert("操作有误")
                 }else{
                  alert("操作有误")
            }
          },'json')
      }
      $(document).on('click','.dels',function(){
        var _this=$(this)
        var goods_id=_this.parents('tr').attr('goods_id')
        alert(goods_id)
      })
      $(document).on('click','.jiesuan',function(){
         var _box=$(".box:checked")
            if(_box.length>0){
                var goods_id=""
                _box.each(function(index){
                 goods_id+=   $(this).parents("tr").attr("goods_id")+","
                })
                goods_id=goods_id.substr(0,goods_id.length-1)
                // alert(goods_id)
                location.href="{{url('/buy')}}/"+goods_id
            }else{
                alert("选一件商品")
            }
      })
     })
   </script>
     @endsection