<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apple extends Model
{
    protected $table = 'Apples';

    protected $fillable = ['size', 'color', 'top', 'left', 'status'];
}
