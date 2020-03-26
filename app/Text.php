<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    //
   protected $table="text";
   protected $primaryKey='text_id';
   public $timestamps=false;
   protected $guarded=[];
}
