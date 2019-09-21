<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class goods extends Model
{
<<<<<<< HEAD
    public $timestamps = false;
=======
    protected $table= 'goods';
    protected $primaryKey= 'goods_id';
    public $timestamps = false;
    protected $guarded = [];
>>>>>>> 93dffc73519265a7440159f9a6ae35a9322f62a1
}
