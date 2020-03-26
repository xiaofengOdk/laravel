<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
   protected $table="goods";
   protected $primaryKey='goods_id';
   public $timestamps=false;
   protected $guarded=[];
   public static function new_res(){
   		$new_res=Goods::where('is_new',1)->take(4)->get();
   		return $new_res;
   }
   public function up_res(){
   		$up_res=Goods::where('is_up',1)->take(4)->get();
  		return $up_res;
   }
   public function hot_res(){
		$hot_res=Goods::where('is_hot',1)->take(4)->get();
		return $hot_res;
   }
}
