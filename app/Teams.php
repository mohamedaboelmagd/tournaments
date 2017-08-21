<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $table = 'teams';
    public $timestamps = false;
    protected $fillable = ['name','logo'];
    protected $primaryKey = 'id';
}
