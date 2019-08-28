<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public $table = 'thot_admin_usuarios';
    public $timestamps = false;
    protected $hidden = [
    	'pass_usuario'
    ];
}
