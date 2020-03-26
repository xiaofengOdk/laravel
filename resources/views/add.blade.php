<h1>控制器走起</h1>
<form action="{{url('/index')}}" method="post">
	{{csrf_field()}}
	名称<input type="text" name="name">
	<input type="submit" value="提交">
</form>