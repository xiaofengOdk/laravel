 @foreach ($res as $k=>$v)
   
    <tr>
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