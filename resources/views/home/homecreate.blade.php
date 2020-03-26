<!-- @if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif -->
<form class="form-inline" role="form" action="{{url('/home_index')}}" enctype="multipart/form-data" method="post">
  {{csrf_field()}}
  <div class="form-group">
    <label class="sr-only" for="name" >房屋名称</label>
    <input type="text" class="form-control"  name="home_name" id="home_name" placeholder="请输入名称">
    <div class="alert alert-danger">{{$errors->first('home_name')}}</di
v>  </div>
  <div class="form-group">
    <label class="sr-only" for="name">房屋价格</label>
     <input type="text" class="form-control"  name="home_buy" id="home_buy" placeholder="请输入价格">
  
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">房屋人</label> 
        <input type="text" class="form-control"  name="home_man" id="home_buy" >
  <div class="alert alert-danger">{{$errors->first('home_man')}}</di
v></div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >房屋面积</label>
    <input type="text" id="inputfile" name="home_mian">
  </div>
   <div class="form-group">
    <label class="sr-only" for="inputfile" >电话</label>
    <input type="text" id="inputfile" name="home_tel">
  </div>
    <div class="form-group">
    <label class="sr-only" for="inputfile" >房屋图片</label>
    <input type="file" id="inputfile" name="home_logo">
  </div> 
   <div class="form-group">
    <label class="sr-only" for="inputfile" >房屋相册</label>
    <input type="file" id="inputfile"  multiple name="home_logos[]">
  </div>
  <button type="submit" class="btn btn-default">提交</button>
</form>