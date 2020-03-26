<form class="form-inline" role="form" action="{{url('/cateupdate/'.$res->cate_id)}}" enctype="multipart/form-data" method="post">
  {{csrf_field()}}
  <div class="form-group">
    <label class="sr-only" for="name" >分类名称</label>
    <input type="text" class="form-control"  name="cate_name" id="cate_name" value="{{$res->cate_name}}" placeholder="请输入名称">
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">分类</label>
    <select name="pid">
      <option value='1' >好的</option>
      <option value='2'>坏的</option>
    </select>
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">是否在导航栏</label> 
    <input type="radio" id="inputfile" name="cate_nav_show" value="1" {{$res->cate_nav_show==1?"checked":""}}>是
    <input type="radio" id="inputfile" name="cate_nav_show" value="2"{{$res->cate_nav_show==2?"checked":""}}>否 
  </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >是否显示</label>
    <input type="radio" id="inputfile" name="cate_show" value="1"{{$res->cate_nav_show==1?"checked":""}}>是
    <input type="radio" id="inputfile" name="cate_show" value="2"{{$res->cate_nav_show==2?"checked":""}}>否
  </div>
  <button type="submit" class="btn btn-default">修改</button>
</form>