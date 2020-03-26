<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
   protected $table="category";
   protected $primaryKey='cate_id';
   public $timestamps=false;
   protected $guarded=[];
   public function pid_res(){
		$pid_res=Category::where('pid',1)->take(4)->get();
		return $pid_res;
   }
}
