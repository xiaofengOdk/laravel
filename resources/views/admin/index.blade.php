<h1><a href="{{url('/login/index')}}">反弹</a></h1>
<table class="table table-striped">
  <caption>Admin表中的数据</caption>
  <thead>
    <tr>
      <th>管理员名称</th>
      <th>管理员电话</th>
      <th>邮箱</th>
      <th>管理员图片</th>
      <th>操作</th>
    </tr>
      @foreach ($res as $k=>$v)
     <tr>
      <th>{{$v->admin_name}}</th>
      <th>{{$v->admin_tel}}</th>
      <th>{{$v->admin_email}}</th>
      <th><img src="{{env('UPLOADS_URL')}}{{$v->admin_logo}}" width="100px" height="100px"></th>
      <th>
        <a href="{{url('/admin/edit/'.$v->admin_id)}}">编辑</a>
        <a href="{{url('/admin/destroy/'.$v->admin_id)}}">删除</a>
      </th>
    </tr>
    @endforeach
    <tr>
      <th colspan="5">{{$res->links()}}</th>
    </tr>
  </thead>
</table>
