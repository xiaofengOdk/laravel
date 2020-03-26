<form class="form-inline" role="form" action="{{url('/goods/store')}}" enctype="multipart/form-data" method="post">
  {{csrf_field()}}
  <div class="form-group">
    <label class="sr-only" for="name" >商品名称</label>
    <input type="text" class="form-control"  name="goods_name" id="name" placeholder="请输入名称">
  
  <p>{{$errors->first('goods_name')}}</p></div>
  <div class="form-group">
    <label class="sr-only" for="name">价格</label>
    <input type="text" class="form-control" id="name" name="goods_price">
  
  <p>{{$errors->first('goods_price')}}</p></div>
  <div class="form-group">
    <label class="sr-only" for="name">库存</label> 
    <input type="text" class="form-control" id="name" name="goods_num" placeholder="库存">
  
  <p>{{$errors->first('goods_num')}}</p></div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >商品图片</label>
    <input type="file" id="inputfile" name="goods_img">
  </div>
   <div class="form-group">
    <label class="sr-only" for="inputfile" >商品图策</label>
    <input type="file" id="inputfile" name="goods_imgs[]" multiple>
  </div>
   <div class="form-group">
    <label class="sr-only" for="inputfile" >是否热卖</label>
    <input type="radio" id="inputfile" name="is_hot" value='1'>是
    <input type="radio" id="inputfile" name="is_hot" value='2'>否
  </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >是否最新</label>
    <input type="radio" id="inputfile" name="is_new" value='1'>是
    <input type="radio" id="inputfile" name="is_new" value='2'>否
  </div>
   <div class="form-group">
    <label class="sr-only" for="inputfile" >是否上市</label>
    <input type="radio" id="inputfile" name="is_up" value='1'>是
    <input type="radio" id="inputfile" name="is_up" value='2'>否
  </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >商品描述</label>
    <input type="text" id="inputfile" name="goods_desc" multiple>
  
  <p>{{$errors->first('goods_desc')}}</p></div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >brand数据</label>
     <select name="brand_id">
      @foreach($brand_res as $k=>$v)
       <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
      @endforeach
   
   <p>{{$errors->first('brand_id')}}</p>  </select>  
  </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >cate数据</label>
     <select name="cate_id">
        @foreach($cate_res as $k=>$v)
       <option value="{{$v->cate_id}}">{{str_repeat("---------",$v->level)}}{{$v->cate_name}}</option>
       @endforeach
   
   <p>{{$errors->first('cate_id')}}</p>  </select>  
  </div>
  <button type="submit" class="btn btn-default">提交</button>
</form>