<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
	protected $table = 'value';
    protected $primaryKey = 'idvalue';
    public $timestamps = true; 
}
