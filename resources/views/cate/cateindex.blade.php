<h1><a href="{{url('/login/index')}}">反弹</a></h1>
<table class="table table-striped">
  <caption>Category表中的数据</caption>
  <thead>
    <tr>
      <th>cate的名称</th>
      <th>是否在导航显示</th>
      <th>是否显示</th>
      <th>cate的分类</th>
      <th>操作</th>
    </tr>
      @foreach ($res as $k=>$v)
     <tr>
      <th>{{$v->cate_name}}</th>
      <th>{{$v->cate_show==1?"是":"否"}}</th>
      <th>{{$v->cate_nav_show==1?"是":"否"}}</th>
      <th>{{$v->pid}}</th>
      <th>
        <a href="{{url('/cateedit/'.$v->cate_id)}}">编辑</a>
        <a href="{{url('/catedestroy/'.$v->cate_id)}}">删除</a>
      </th>
    </tr>
    @endforeach
  </thead>
</table>
{{$res->links()}}