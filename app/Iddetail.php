<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iddetail extends Model
{
    protected $fillable = ['owner','means','idnum','idexpire','user_id'];
}
