<form>
  <input type="text" name="name" value="{{$query['name']??''}}">
  <input type="text" name="man" value="{{$query['man']??''}}">
  <input type="submit" name="">
</form>
<table class="table table-striped">
  <caption>Book表中的数据</caption>
  <thead>
    <tr>
      <th>图书名称</th>
      <th>图书价格</th>
      <th>图书作者</th>
      <th>图书图片</th>
      <th>操作</th>
    </tr>
      @foreach ($res as $k=>$v)
     <tr>
      <th>{{$v->book_name}}</th>
      <th>{{$v->book_price}}</th>
      <th>{{$v->book_man}}</th>
      <th><img src="{{env('UPLOADS_URL')}}{{$v->book_logo}}" width="100px" height="100px"></th>
      <th>
        <a href="{{url('/edit/'.$v->book_id)}}">编辑</a>
        <a href="{{url('/destroy/'.$v->book_id)}}">删除</a>
      </th>
    </tr>
    @endforeach
    <tr>
      <th colspan="5">{{$res->appends($query)->links()}}</th>
    </tr>
  </thead>
</table>
