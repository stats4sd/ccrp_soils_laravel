<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    public $table = 'contactus';

    public $fillable = ['name','email','message'];
}
