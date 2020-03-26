<form class="form-inline" role="form" action="{{url('/login/store')}}" enctype="multipart/form-data" method="post">
  {{csrf_field()}}
    {{session('msg')}}
  <div class="form-group">
    <label class="sr-only" for="name" >账号</label>
    <input type="text" class="form-control"  name="admin_name" id="admin_name"  placeholder="请输入名称">
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">密码</label> 
   <input type="password" id="inputfile" name="admin_pwd" > 
  </div>
  <button type="submit" class="btn btn-default">登录</button>
</form>