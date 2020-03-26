<form class="form-inline" role="form" action="{{url('/new/store')}}" enctype="multipart/form-data" method="post">
  {{csrf_field()}}
  <div class="form-group">
    <label class="sr-only" for="name" >新闻名称</label>
    <input type="text" class="form-control"  name="new_name" id="name" placeholder="请输入名称">
    <p>{{$errors->first('new_name')}}</p>
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">新闻描述</label>
    <input type="text" class="form-control" id="name" name="new_desc">
    <p>{{$errors->first('new_desc')}}</p>
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">价格</label> 
    <select name="pid">
      <option value="0">请选择</option>
        @foreach($sres as $k=>$v)
      <option value="{{$v->new_id}}">{{$v->new_name}}</option>
        @endforeach
    </select>
  </div>
   <div class="form-group">
    <label class="sr-only" for="name">新闻作者</label>
    <input type="text" class="form-control" id="name" name="new_man">
    <p>{{$errors->first('new_man')}}</p>
  </div>
  <button type="submit" class="btn btn-default">提交</button>
</form>