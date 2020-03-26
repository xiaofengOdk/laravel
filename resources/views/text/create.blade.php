<form class="form-inline" role="form" action="{{url('/text/store')}}" enctype="multipart/form-data" method="post">
  {{csrf_field()}}
  <div class="form-group">
    <label class="sr-only" for="name" >文章名称</label>
    <input type="text" class="form-control"  name="text_name" id="name" placeholder="请输入名称">
    <span id="name_span"> </span>
  <p>{{$errors->first('text_name')}}</p></div>
  <div class="form-group">
    <label class="sr-only" for="name">文章作者</label>
    <input type="text" class="form-control" id="man" name="text_man">
      <span id="man_span"> </span>

  <p>{{$errors->first('text_man')}}</p></div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >文章图片</label>
    <input type="file" id="inputfile" name="text_logo">
  </div>
   <div class="form-group">
    <label class="sr-only" for="inputfile" >是否好看</label>
    <input type="radio" id="inputfile" name="is_hot" value='1'>是
    <input type="radio" id="inputfile" name="is_hot" value='2'checked>否
  </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >是否展示</label>
    <input type="radio" id="inputfile" name="is_show" value='1'  checked>是
    <input type="radio" id="inputfile" name="is_show" value='2'>否
  </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >文章描述</label>
    <input type="text" id="inputfile" name="text_desc" multiple>
        <span id="desc_span"> </span>

  <p>{{$errors->first('text_desc')}}</p></div>
   <div class="form-group">
    <label class="sr-only" for="inputfile" >文章邮箱</label>
    <input type="text" id="email" name="text_email" multiple>
      <span id="email_span"> </span>
  <p>{{$errors->first('text_email')}}</p></div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >brand数据</label>
     <select name="brand_id">
      @foreach($brand_res as $k=>$v)
       <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
      @endforeach
   
   <p>{{$errors->first('brand_id')}}</p>  </select>  
  </div>
  <button type="submit" class="btn btn-default">提交</button>
</form>
<script type="text/javascript" src="{{asset('static/admin/js/jquery.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('blur','#name',function(){
      var _this=$(this).val()
       // alert(_this)
      var reg=/^[\u4e00-\u9fa5]{3,}$/
      if(_this==''){
        $('#name_span').html("不能为空")
              return false
    }else if(!reg.test(_this)){
        $('#name_span').html("格式不正确")    
              return false
    }else{
              $('#name_span').html("ok")
              return true    
    }

    })
    $(document).on('blur','#email',function(){
        var _this=$(this).val()
        var reg=/^[a-zA-Z0-9]{6,}@qq\.com$/
        if(_this==''){
          $('#email_span').html("非空")    
            return false
        }else if(!reg.test(_this)){
          $('#email_span').html("格式不正确")    
               return false
     }else{
              $('#email_span').html("ok")   
                            return true    
 
     }
   })
        $(document).on('blur','#man',function(){
            var _this=$(this).val()
         if(_this==''){
          $('#man_span').html("非空")    
            return false
        }else{
            $('#man_span').html("ok")    
            return true
        }
      })
         $(document).on('blur','#inputfile',function(){
            var _this=$(this).val()
         if(_this==''){
          $('#desc_span').html("非空")    
            return false
        }else{
            $('#desc_span').html("ok")    
            return true
        }
      })
  })
</script>