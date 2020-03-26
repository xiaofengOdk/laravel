<form>
  <input type="text" name="name" value="{{$query['name']??''}}">
  <input type="text" name="n_name" value="{{$query['n_name']??''}}">
  <input type="submit" name="">
</form>
<table class="table table-striped">
  <caption>Text表中的数据</caption>
  <thead>
    <tr>
      <th>text的名称</th>
      <th>是否展示</th>
      <th>是否重要</th>
      <th>描述</th>
      <th>商品图片</th>
      <th>邮件</th>      
      <th>作者</th>      
        <th>时间</th>      
    <th>brand的分类</th>
      <th>操作</th>
    </tr>
    <tbody>
      @foreach ($res as $k=>$v)
    <tr text_id="{{$v->text_id}}"> 
      <th>{{$v->text_name}}</th>
      <th>{{$v->is_show==1?"是":"否"}}</th>
      <th>{{$v->is_hot==1?"是":"否"}}</th>
      <th>{{$v->text_desc}}</th>
      <th><img src="{{env('UPLOADS_URL')}}{{$v->text_logo}}" width="100px" height="100px"></th>
      <th>{{$v->text_email}}</th>      
      <th>{{$v->text_man}}</th>      
      <th>{{date("Y-m-d H:i:s",$v->text_time)}}</th>
      <th>{{$v->brand_name}}</th>
      <th>
<!--         <a href="{{url('/text/destroy/'.$v->text_id)}}" >删除</a>
 -->       
   <button class="dels">删除</button>
         <a href="{{url('/text/edit/'.$v->text_id)}}">编辑</a>
     </th>
    </tr>
      @endforeach
      </tbody>
  </thead>
</table>
{{$res->appends($query)->links()}}
<script type="text/javascript" src="{{asset('static/admin/js/jquery.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.pagination a',function(){
      // alert(1);
      var _this=$(this)
      var url=_this.attr('href')
      // alert(url)
      $.get(url,function(result){
        // console.log(result)
        $('tbody').html(result)
      })
      return false
    })
    $(document).on('click','.dels',function(){
      var _this=$(this)
      var text_id=_this.parents('tr').attr("text_id")
      // alert(text_id);
      // return false 
     // if(window.confirm("是否删除")){
     //    location.href="{{url('/text/destroy')}}/"+text_id
     //  }
     if(confirm("是否删除")){
      $.get('/text/destroy/'+text_id,function(res){
        if(res.code=='00000'){
          location.reload();
        }
      },'json')
      
     }
    })
  })
</script>