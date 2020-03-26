<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class IndexController extends HttpKernel
{
	public function index(){
		// return view("add");
	if(request()->isMethod('get')){
		return view("add");
	}	
	if(request()->isMethod('post')){
		$data=request()->name;
		echo $data;
 	}
	}
// 	public function adddo(){
// 		$data=request()->name;
// 		echo $data;
// 	 		return redirect('/index'); 
// }
	public 	function ooo($id,$name){
		echo $id;
		echo $name;
	}
}