<?php

namespace App\Http\Controllers;

use App\Matches;
use App\Ranking;
use App\Teams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class MatchesController extends Controller
{
    public function index(){
        $ranking = DB::table('teams')
                ->selectRaw('ranking.team_id as team_id, ranking.matches_played as matches_played,
                 ranking.win as win, ranking.draw as draw , ranking.loss as loss
                , ranking.goals_in as goals_in, ranking.goals_out as goals_out, ranking.points as points,
                teams.id as id, teams.name as name, teams.logo as logo')
                ->leftJoin('ranking', function ($join) {
                    $join->on('ranking.team_id', '=', 'teams.id');
                })
                //->whereNotNull('team_id')
                ->orderBy('points', 'des')
                ->get();
        //var_dump($ranking);die;

        return view('welcome')->with(['data'=>$ranking]);
    }

    public function addTeams()
    {
        $image = Input::file('logoInputFile');
        if(!is_null($image)){
            $filename = $image->getClientOriginalName();
            $image->move(public_path().'/images/',$filename);
        }else{
            flash('Check Your image', 'warning');
            return Redirect::back();
        }


        if (Teams::where('name', '=', Input::get('nameInput'))->exists()) {
            flash('Check Your Name As It\'s exiestence before', 'warning');
        }else{
            $team = new Teams;
            $team->name = Input::get('nameInput');
            $team->logo = '/images/'.$filename;
            $team->save();
        }

        return Redirect::back();
    }

    public function addMatches(){
        if (Input::get('team1') == Input::get('team2')){
            flash('Check Your Inputs', 'warning');
        }else{
            $matches = new Matches;
            $matches->home_team = Teams::where('name', '=', Input::get('team1'))->value('name');
            $matches->away_team = Teams::where('name', '=', Input::get('team2'))->value('name');
            $matches->save();
        }
        return Redirect::back();
    }

    public function showMatches(){
        return view('matches')->with(['matches'=>Matches::all()]);
    }

    public function addScores(){
        $matches = Matches::find(Input::get('idMatch'));
        $matches->goals_in = Input::get('nameInput1');
        $matches->goals_out = Input::get('nameInput2');
        $matches->update();
        //name
        $name_home_team = Matches::find(Input::get('idMatch'))->home_team;
        $name_away_team = Matches::find(Input::get('idMatch'))->away_team;
        MatchesController::saveScores($name_home_team,$name_away_team);
        //die;
        return Redirect::back();
    }

    protected static function saveScores($name_home_team,$name_away_team){
        if(Ranking::where('team_id', '=', Teams::where('name', '=', $name_home_team)->value('id'))->exists()){
            //update rank
            //$rank = DB::table('ranking')->where('team_id', '=', Teams::where('name', '=', $name_home_team)->value('id'))->first();
            $rank = Ranking::where('team_id', '=', Teams::where('name', '=', $name_home_team)->value('id'))->first();
            //var_dump($rank);die;
            ++$rank->matches_played;
            if(Input::get('nameInput1') > Input::get('nameInput2')){
                ++$rank->win;
                $rank->points += 3;
            }elseif (Input::get('nameInput1') == Input::get('nameInput2')){
                ++$rank->draw;
                ++$rank->points;
            }else{
                ++$rank->loss;
            }
            $rank->goals_in += Input::get('nameInput1');
            $rank->goals_out += Input::get('nameInput2');

            $rank->update();
        }else{
            //save new
            $rank = new Ranking;

            $rank->team_id = Teams::where('name', '=', $name_home_team)->value('id');
            $rank->matches_played = 1;
            if(Input::get('nameInput1') > Input::get('nameInput2')){
                $rank->win = 1;
                $rank->points = 3;
            }elseif (Input::get('nameInput1') == Input::get('nameInput2')){
                $rank->draw = 1;
                $rank->points = 1;
            }else{
                $rank->loss = 1;
            }
            $rank->goals_in = Input::get('nameInput1');
            $rank->goals_out = Input::get('nameInput2');
            $rank->save();
        }

        //var_dump($rank);
        if(Ranking::where('team_id', '=', Teams::where('name', '=', $name_away_team)->value('id'))->exists()){
            //update rank
            //$rank = DB::table('ranking')->where('team_id', '=', Teams::where('name', '=', $name_away_team)->value('id'))->first();
            $rank = Ranking::where('team_id', '=', Teams::where('name', '=', $name_away_team)->value('id'))->first();
            //var_dump($rank);die;
            ++$rank->matches_played;
            if(Input::get('nameInput1') < Input::get('nameInput2')){
                ++$rank->win;
                $rank->points += 3;
            }elseif (Input::get('nameInput1') == Input::get('nameInput2')){
                ++$rank->draw;
                ++$rank->points;
            }else{
                ++$rank->loss;
            }
            $rank->goals_in += Input::get('nameInput2');
            $rank->goals_out += Input::get('nameInput1');

            $rank->update();
        }else{
            //save new
            $rank = new Ranking;

            $rank->team_id = Teams::where('name', '=', $name_away_team)->value('id');
            $rank->matches_played = 1;
            if(Input::get('nameInput1') < Input::get('nameInput2')){
                $rank->win = 1;
                $rank->points = 3;
            }elseif (Input::get('nameInput1') == Input::get('nameInput2')){
                $rank->draw = 1;
                $rank->points = 1;
            }else{
                $rank->loss = 1;
            }
            $rank->goals_in = Input::get('nameInput2');
            $rank->goals_out = Input::get('nameInput1');
            $rank->save();
        }
    }
}
