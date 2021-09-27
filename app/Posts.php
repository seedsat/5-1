<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use SoftDeletes;
    protected $guarded = array('id');

    public static $rules = array(
        'body' => 'required|max:255'
    );
}
