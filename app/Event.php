<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable=['title','description','startdate','enddate','starttime','endtime','user_id','isfinished'];
    
    
}
