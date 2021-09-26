<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'body' => 'required|max:255'
    );
}
