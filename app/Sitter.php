<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sitter extends Model
{
    protected $guard = 'sitter';

    protected $fillable = [
         'iduser','aboutme','photo','gender','sit_exper','dob','marital_stat','availability','rate1','rate2', 'rate3','highedu','med_avail','ref_fname', 'ref_lname','ref_phone','ref_address','ref_city','ref_state',
    ];

    protected $hidden = [
            'password', 'remember_token',
        ];
}
