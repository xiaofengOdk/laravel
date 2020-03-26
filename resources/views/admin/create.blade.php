<form class="form-inline" role="form" action="{{url('/admin/store')}}" enctype="multipart/form-data" method="post">
  {{csrf_field()}}
  <div class="form-group">
    <label class="sr-only" for="name" >管理员名称</label>
    <input type="text" class="form-control"  name="admin_name" id="name" placeholder="请输入名称">
    <span id='name_span'></span>
    <p>{{$errors->first('admin_name')}}</p>
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">管理员手机号</label>
    <input type="text" class="form-control" id="tel" name="admin_tel">
    <p>{{$errors->first('admin_tel')}}</p>
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">邮箱</label> 
    <input type="text" class="form-control" id="email" name="admin_email">
    <p>{{$errors->first('admin_email')}}</p>
  </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >管理员密码</label>
    <input type="password" id="pwd"name="admin_pwd">
    <p>{{$errors->first('admin_pwd')}}</p>
  </div>
   <div class="form-group">
    <label class="sr-only" for="inputfile" >头像</label>
    <input type="file" id="inputfile" name="admin_logo">
  </div>
  <button type="submit" class="btn btn-default">提交</button>
</form>
<link rel="stylesheet" href="{{ URL::asset('js/amazeui.min.css') }}">
<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
 <script type="text/javascript">
    $(document).ready(function(){
      $('#name').blur(function(){
        var _this=$(this)
        var reg=/^[\u4e00-\u9fa5]$/
         if(_this==''){
            $('#name_span').html('非空')
         }
          if(!reg.test(_this)){
            $('#name_span').html('非空')
            return  false
          }
      })
    })
</script>