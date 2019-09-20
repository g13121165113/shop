<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class shop extends Model
{
    protected $table= 'shop';
    protected $primaryKey= 'shop_id';
    public $timestamps = false;
    protected $guarded = [];
}
