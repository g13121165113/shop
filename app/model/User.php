<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table='user';
    protected $primaryKey= 'goods_id';
    public $timestamps = false;
}
