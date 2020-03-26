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
   <button class="dels">删除</button>
         <a href="{{url('/text/edit/'.$v->text_id)}}">编辑</a>
     </th>
    </tr>
      @endforeach