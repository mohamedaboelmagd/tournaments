<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    protected $table = 'matches';
    public $timestamps = false;
    protected $fillable = ['home_team','away_team','goals_in','goals_out'];
    protected $primaryKey = 'id';
}
