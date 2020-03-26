<form class="form-inline" role="form" action="{{url('/test/store')}}" method="post">
  {{csrf_field()}}
  <div class="form-group">
    <label class="sr-only" for="name" >新闻名称</label>
    <input type="text" class="form-control"  name="name" id="name" placeholder="请输入名称">
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">是否好看</label>
    <input type="radio" class="form-control"  name="is_ok" value="2">不好看
    <input type="radio" class="form-control"  name="is_ok" value="1">好看
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">描述</label> 
    <input type="text" class="form-control"name="desc">    
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">新闻作者</label> 
    <input type="text" class="form-control"name="man">    
  </div>
  <button type="submit" class="btn btn-default">提交</button>
</form>