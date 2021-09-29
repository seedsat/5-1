<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use SoftDeletes;
    
    protected $guarded = array('id');

    protected $dates = ['created_at', 'deleted_at'];

    public static $rules = array(
        'body' => 'required|max:255'
    );
}
