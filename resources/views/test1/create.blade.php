<table class="table table-striped">
  <caption>学生</caption>
  <thead>
    <tr>
      <th>学生名称</th>
      <th>学生性别</th>
      <th>学生班级</th>
      <th>操作</th>
    </tr>
      @foreach ($res as $k=>$v)
     <tr>
      <th>{{$v->name}}</th>
      <th>{{$v->sex}}</th>
      <th>{{$v->class}}</th>
      <th>删除|修改</th>
    </tr>
    @endforeach
  </thead>
</table>