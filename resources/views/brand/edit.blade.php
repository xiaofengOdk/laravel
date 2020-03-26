<form class="form-inline" role="form" action="{{url('/update/'.$res->brand_id)}}" method="post">
  {{csrf_field()}}
  <div class="form-group">
    <label class="sr-only" for="name" >名称</label>
    <input type="text" class="form-control"   value="{{$res->brand_name}}"name="brand_name" id="name" placeholder="请输入名称">
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">描述</label>
    <input type="text" class="form-control" id="name" value="{{$res->brand_desc}}" name="brand_desc"placeholder="描述">
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">网站</label> 
    <input type="text"   value="{{$res->brand_url}}"class="form-control" id="name" name="brand_url" placeholder="网站">
  </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" name="brand_logo">文件输入</label>
    <input type="file" id="inputfile">
  </div>
  <button type="submit" class="btn btn-default">修改</button>
</form>