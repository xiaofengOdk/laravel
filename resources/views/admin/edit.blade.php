<form class="form-inline" role="form" action="{{url('/admin/update/'.$res->admin_id)}}" enctype="multipart/form-data" method="post">
  {{csrf_field()}}
  <div class="form-group">
    <label class="sr-only" for="name" >管理员名称</label>
    <input type="text" class="form-control"  value="{{$res->admin_name}}" name="admin_name" id="name" placeholder="请输入名称">
    <p>{{$errors->first('admin_name')}}</p>
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">管理员手机号</label>
    <input type="text" class="form-control"  value="{{$res->admin_tel}}" id="name" name="admin_tel">
     <p>{{$errors->first('admin_tel')}}</p>
 </div>
  <div class="form-group">
    <label class="sr-only" for="name">邮箱</label> 
    <input type="text" class="form-control" id="name" value="{{$res->admin_email}}" name="admin_email">
     <p>{{$errors->first('admin_email')}}</p>
 </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >管理员密码</label>
    <input type="password" id="inputfile" name="admin_pwd" value="{{$res->admin_pwd}}">
      <p>{{$errors->first('admin_pwd')}}</p>
</div>
   <div class="form-group">
    <label class="sr-only" for="inputfile" >头像</label>
    <input type="file" id="inputfile" name="admin_logo">
  </div>
  <button type="submit" class="btn btn-default">修改</button>
</form>