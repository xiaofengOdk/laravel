 @foreach ($res as $k=>$v)
     <tr>
      <th>{{$v->name}}</th>
      <th>{{$v->is_ok=='1'?'好看':"不中"}}</th>
      <th>{{$v->desc}}</th>
      <th>{{date('Y-m-d H:i:s',$v->time)}}</th>
      <th>{{$v->man}}</th>
      <th>删除|修改</th>
    </tr>
    @endforeach