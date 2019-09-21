<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\model\centers;

class centers extends Model
{
	protected $table = 'admin_users';
	protected $primaryKey = 'id';
	public $timestamps = false;
	protected $guarded = [];
}