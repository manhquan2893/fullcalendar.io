<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewerEvent extends Model
{
    //
    protected $table="viewer_event";
    protected $fillable=['viewer_id','event_id'];
}
