<form class="form-inline" role="form" action="{{url('/goods/update/'.$res->goods_id)}}" enctype="multipart/form-data" method="post">
  {{csrf_field()}}
  <div class="form-group">
    <label class="sr-only" for="name" >商品名称</label>
    <input type="text" class="form-control"  name="goods_name" id="name"  value="{{$res->goods_name}}"placeholder="请输入名称">
    <p>{{$errors->first('goods_name')}}</p>
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">价格</label>
    <input type="text" class="form-control" id="name" value="{{$res->goods_price}}"name="goods_price">
   <p>{{$errors->first('goods_price')}}</p> 
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">库存</label> 
    <input type="text" class="form-control" id="name" name="goods_num" value="{{$res->goods_num}}"placeholder="库存">
  <p>{{$errors->first('goods_num')}}</p>  
</div>
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
    <input type="radio" id="inputfile" name="is_hot" value='1' {{$res->is_hot==1?"checked":""}}>是
    <input type="radio" id="inputfile" name="is_hot" value='2'  {{$res->is_hot==2?"checked":""}}>否
  </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >是否最新</label>
    <input type="radio" id="inputfile" name="is_new" value='1'{{$res->is_new==1?"checked":""}}>是
    <input type="radio" id="inputfile" name="is_new" value='2'  {{$res->is_new==2?"checked":""}}>否
  </div>
   <div class="form-group">
    <label class="sr-only" for="inputfile" >是否上市</label>
    <input type="radio" id="inputfile" name="is_up" value='1' {{$res->is_up==1?"checked":""}}>是
    <input type="radio" id="inputfile" name="is_up" value='2'   {{$res->is_up==2?"checked":""}}>否
  </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >商品描述</label>
    <input type="text" id="inputfile" name="goods_desc" value="{{$res->goods_desc}}">
    <p>{{$errors->first('goods_desc')}}</p>
  </div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >brand数据</label>
     <select name="brand_id">
      @foreach($brand_res as $k=>$v)
       <option value="{{$v->brand_id}}" {{$v->brand_id==$res->brand_id?"selected":""}}  >{{$v->brand_name}}</option>
      @endforeach
     </select>  
      <p>  {{$errors->first('brand_id')}}
</p>
</div>
  <div class="form-group">
    <label class="sr-only" for="inputfile" >cate数据</label>
     <select name="cate_id">
        @foreach($cate_res as $k=>$v)
       <option value="{{$v->cate_id}}" {{$v->cate_id==$res->cate_id?"selected":""}}>{{$v->cate_name}}</option>
       @endforeach
     </select>  
     <p>{{$errors->first('cate_id')}}</p>
  </div>
  <button type="submit" class="btn btn-default">修改</button>
</form>