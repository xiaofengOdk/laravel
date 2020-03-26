<form class="form-inline" role="form" action="{{url('/text/update/'.$res->text_id)}}" enctype="multipart/form-data" method="post">
  {{csrf_field()}}
  <div class="form-group">
    <label class="sr-only" for="name" >文章名称</label>
    <input type="text" class="form-control"  name="text_name" id="name" value="{{$res->text_name}}" placeholder="请输入名称">
  
  <p>{{$errors->first('text_name')}}</p></div>
  <div class="form-group">
    <label class="sr-only" for="name">文章作者</label>
    <input type="text" class="form-control" id="name" value="{{$res->text_man}}" name="text_man">
  
  <p>{{$errors->first('text_man')}}</p></div>
 <div class="form-group">
    <label class="sr-only" for="inputfile" >文章邮箱</label>
    <input type="text" id="inputfile" name="text_email" value="{{$res->text_email}}">
  
  <p>{{$errors->first('text_email')}}</p></div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >文章图片</label>
    <input type="file" id="inputfile" name="text_logo">
  </div>
   <div class="form-group">
    <label class="sr-only" for="inputfile" >是否好看</label>
    <input type="radio" id="inputfile" name="is_hot" value='1' {{$res->is_hot==1?"checked":""}}>是
    <input type="radio" id="inputfile" name="is_hot" value='2'{{$res->is_hot==2?"checked":""}}>否
  </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >是否展示</label>
    <input type="radio" id="inputfile" name="is_show" value='1'{{$res->is_show==1?"checked":""}}>是
    <input type="radio" id="inputfile" name="is_show" value='2'{{$res->is_show==1?"checked":""}}>否
  </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >文章描述</label>
    <input type="text" id="inputfile" name="text_desc" value="{{$res->text_desc}}" multiple>
  
  <p>{{$errors->first('text_desc')}}</p></div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >brand数据</label>
     <select name="brand_id">
      @foreach($brand_res as $k=>$v)
       <option value="{{$v->brand_id}}" {{$v->brand_id==$res->brand_id?"selected":""}}>{{$v->brand_name}}</option>
      @endforeach
     </select> 
     <p>{{$errors->first('brand_id')}}</p>
  </div>
  <button type="submit" class="btn btn-default">修改</button>
</form>