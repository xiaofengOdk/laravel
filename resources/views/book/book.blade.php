<form class="form-inline" role="form" action="{{url('/book/store')}}" enctype="multipart/form-data" method="post">
  {{csrf_field()}}
  <div class="form-group">
    <label class="sr-only" for="name" >图书名称</label>
    <input type="text" class="form-control"  name="book_name" id="name" placeholder="请输入名称">
    <p>{{$errors->first('book_name')}}</p>
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">作者</label>
    <input type="text" class="form-control" id="name" name="book_man">
    <p>{{$errors->first('book_man')}}</p>
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">价格</label> 
    <input type="text" class="form-control" id="name" name="book_price">
  </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >文件输入</label>
    <input type="file" id="inputfile" name="book_logo">
  </div>
  <button type="submit" class="btn btn-default">提交</button>
</form>