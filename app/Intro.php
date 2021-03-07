<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intro extends Model
{
    //
    protected $fillable = [
        'title', 'append', 'place','master','photo','weekset','starttime','endtime',
    ];
}
