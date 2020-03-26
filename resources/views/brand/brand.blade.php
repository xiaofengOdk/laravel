<form class="form-inline" role="form" action="{{url('/store')}}" enctype="multipart/form-data" method="post">
  {{csrf_field()}}
  <div class="form-group">
    <label class="sr-only" for="name" >名称</label>
    <input type="text" class="form-control"  name="brand_name" id="name" placeholder="请输入名称">
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">描述</label>
    <input type="text" class="form-control" id="name" name="brand_desc"placeholder="描述">
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">网站</label> 
    <input type="text" class="form-control" id="name" name="brand_url" placeholder="网站">
  </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >文件输入</label>
    <input type="file" id="inputfile" name="brand_logo">
  </div>
  <button type="submit" class="btn btn-default">提交</button>
</form>