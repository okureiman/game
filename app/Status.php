<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $guarded = array('status_id');
     
    public static $rules = array(
        'name' => 'required',
        'hp' => 'required',
        'atk' => 'required',
        'def' =>'required',
        );
}
