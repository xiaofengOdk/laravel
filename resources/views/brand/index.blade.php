<h1><a href="{{url('/login/index')}}">反弹</a></h1>
<table class="table table-striped">
  <caption>Brand表中的数据</caption>
  <thead>
    <tr>
      <th>名称</th>
      <th>描述</th>
      <th>网站</th>
      <th>图片</th>
      <th>操作</th>
    </tr>
      @foreach ($res as $k=>$v)
     <tr>
      <th>{{$v->brand_name}}</th>
      <th>{{$v->brand_desc}}</th>
      <th>{{$v->brand_url}}</th>
      <th><img src="{{env('UPLOADS_URL')}}{{$v->brand_logo}}" width="100px" height="100px"></th>
      <th>
        <a href="{{url('/edit/'.$v->brand_id)}}">编辑</a>
        <a href="{{url('/destroy/'.$v->brand_id)}}">删除</a>
      </th>
    </tr>
    @endforeach
    <tr>
      <th colspan="5">{{$res->links()}}</th>
    </tr>
  </thead>
</table>
