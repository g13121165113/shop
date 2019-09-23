<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class goods extends Model
{

    public $timestamps = false;

    protected $table= 'goods';
    protected $primaryKey= 'goods_id';
    protected $guarded = [];

}
