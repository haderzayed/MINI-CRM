<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Company extends Model
{
    use Notifiable;
   protected $guarded=[];

   public function getLogoAttribute($value){

       return  asset('storage/'.$value ) ;
   }


}


