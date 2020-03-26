<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userq extends Model
{
    
   protected $table='userq';
   protected $primaryKey='user_id';
   public $timestamps=false;
   protected $guarded=[];
}
?>