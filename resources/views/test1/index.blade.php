<form class="form-inline" role="form" action="{{url('/store')}}" method="post">
  {{csrf_field()}}
  <div class="form-group">
    <label class="sr-only" for="name" >学生名称</label>
    <input type="text" class="form-control"  name="name" id="name" placeholder="请输入名称">
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">性别</label>
    <input type="radio" class="form-control" id="sex" name="sex" value="女">女
    <input type="radio" class="form-control" id="sex" name="sex" value="男">男
  </div>
  <div class="form-group">
    <label class="sr-only" for="name">班级</label> 
    <select name="class">
        <option>1909</option>
        <option>1908</option>
    </select>
  </div>
  <button type="submit" class="btn btn-default">提交</button>
</form>