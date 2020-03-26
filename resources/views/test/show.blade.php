<form>
  <input type="text" name="name" value="{{$query['name']??''}}">
  <input type="submit" name="">
</form>
<table class="table table-striped">
  <caption>新闻</caption>
  <thead>
    <tr>
      <th>新闻名称</th>
      <th>是否好看</th>
      <th>描述</th>
      <th>时间</th>
      <th>作者</th>
      <th>操作</th>
    </tr>
     <tbody>
      @foreach ($res as $k=>$v)
     <tr>
      <th>{{$v->name}}</th>
      <th>{{$v->is_ok=='1'?'好看':"不中"}}</th>
      <th>{{$v->desc}}</th>
      <th>{{date('Y-m-d H:i:s',$v->time)}}</th>
      <th>{{$v->man}}</th>
      <th>删除|修改</th>
    </tr>
    @endforeach
  </tbody>
  </thead>
</table>
{{$res->appends($query)->links()}}
<script type="text/javascript" src="{{asset('static/admin/js/jquery.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.pagination a',function(){
      // alert(1);
      var _this=$(this)
      var url=_this.attr('href')
      // alert(url)
      var id=url
      // alert(id)
      // return false
      $.get(url,{id:id},function(result){
        console.log(result)
        $('tbody').html(result)
      })
      return false
    })
  })
</script>