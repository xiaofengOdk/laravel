<table class="table table-striped">
  <caption>New表中的数据</caption>
  <thead>
    <tr>
      <th>new的名称</th>
      <th>new的作者</th>
      <th>new时间</th>
      <th>分类</th>
      <th>操作</th>
    </tr>
      @foreach ($res as $k=>$v)
     <tr>
      <th>{{$v->new_name}}</th>
      <th>{{$v->new_man}}</th>
      <th>{{date("Y-m-d H:i:s",$v->new_time)}}
      </th>
      <th>{{$v->new_name}}</th>
      <th>
        <a href="{{url('/cateedit/'.$v->new_id)}}">编辑</a>
        <a href="{{url('/catedestroy/'.$v->new_id)}}">删除</a>
      </th>
    </tr>
    @endforeach
  </thead>
</table>
{{$res->links()}}