<form>
  <input type="text" name="name" value="{{$query['name']??''}}">
  <input type="text" name="url" value="{{$query['url']??''}}">
  <button>查询</button>
</form>
<table class="table table-striped">
  <caption>小区表中的数据</caption>
  <thead>
    <tr>
      <th>小区的名称</th>
      <th>小区的价格</th>
      <th>小区的平方</th>
      <th>小区的人</th>
      <th>小区的图片</th>
      <th>小区图集</th>
      <th>小区电话</th>
      <th>操作</th>
    </tr>
      @foreach ($res as $k=>$v)
     <tr>
      <th>{{$v->home_name}}</th>
      <th>{{$v->home_buy}}</th>
      <th>{{$v->home_mian}}</th>
      <th>{{$v->home_man}}</th>
      <th><img src="{{env('UPLOADS_URL')}}{{$v->home_logo}}" width="100px" height="100px"></th>
       <th> 
        @if($v->home_logos) 
        @php  $logos=explode("|",$v->home_logos) ;@endphp
        @foreach ($logos as $vv)
      <img src="{{env('UPLOADS_URL')}}{{$vv}}" width="39px;"height="30px">
        @endforeach
        @endif
      </th>
      <th>{{$v->home_tel}}</th>
      <th>操作</th>
    </tr>
    @endforeach
  </thead>
</table>
{{$res->appends($query)->links()}}