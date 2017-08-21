<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    protected $table = 'ranking';
    public $timestamps = false;
    protected $fillable = ['team_id','matches_played','win','draw','loss','goals_in','goals_out','points'];
    protected $primaryKey = 'id';
}
