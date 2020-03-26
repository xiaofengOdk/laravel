<h1><a href="{{url('/login/index')}}">反弹</a></h1>
<table class="table table-striped">
  <caption>Goods表中的数据</caption>
  <thead>
    <tr>
      <th>goods的名称</th>
      <th>是否上市</th>
      <th>是否热卖</th>
      <th>是否最新</th>
      <th>商品价格</th>
      <th>商品库存</th>
      <th>商品描述</th>
      <th>商品图片</th>
      <th>相册</th>      
      <th>cate的分类</th>
      <th>brand的分类</th>
      <th>操作</th>
    </tr>
    <tbody>
      @foreach ($res as $k=>$v)
    <tr id='sss'>
      <th>{{$v->goods_name}}</th>
      <th>{{$v->is_up==1?"是":"否"}}</th>
      <th>{{$v->is_hot==1?"是":"否"}}</th>
      <th>{{$v->goods_is_new==1?"是":"否"}}</th>
      <th>{{$v->goods_price}}</th>
      <th>{{$v->goods_num}}</th>
      <th>{{$v->goods_desc}}</th>
      <th>
        <img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="100px" height="100px">
      </th>
      <th>
        @php $imgs=explode("|",$v['goods_imgs']);  @endphp
          @foreach ($imgs as $vv)
        <img src="{{env('UPLOADS_URL')}}{{$vv}}" width="50px" height="50px">
          @endforeach
      </th>      
      <th>{{$v->brand_name}}</th>
      <th>{{$v->cate_name}}</th>
      <th>
        <a href="{{url('/goods/destroy/'.$v->goods_id)}}">删除</a>||
        <a href="{{url('/goods/edit/'.$v->goods_id)}}">编辑</a>
      </th>
    </tr>
      @endforeach
      </tbody>
  </thead>
</table>
{{$res->links()}}
<script type="text/javascript" src="{{asset('static/admin/js/jquery.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.pagination a',function(){
      // alert(1);
      var _this=$(this)
      var url=_this.attr('href')
      alert(url)
      $.get(url,function(result){
        // console.log(result)
        $('tbody').html(result)
      })
      return false
    })
  })
</script>