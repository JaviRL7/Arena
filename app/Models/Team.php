<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'league',
        'country',
        'logo',
        // cualquier otro campo que quieras que sea asignable en masa
    ];
    public function players(){
        return $this->belongsToMany(Player::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }
    public function competition()
    {
        return $this->belongsTo(Competition::class, 'league_id');
    }
    public function getPlayers() {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
                    ->where('start_date', '<=', $today)
                     ->where('end_date', '=', null)
                     ->where('substitute', '=', false)
                     ->orderBy('role_id', 'asc')
                     ->get();

    }
    public function getPlayersSubstitute() {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
                    ->where('start_date', '<=', $today)
                     ->where('end_date', '>=', $today)
                     ->where('substitute', '=', true)
                     ->orderBy('role_id', 'asc')
                     ->get();

    }
    public function getToplaner() {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
                     ->where('role_id', 1)
                     ->where('start_date', '<=', $today)
                     ->where('end_date', '>=', $today)
                     ->orderBy('start_date', 'desc');
    }
    public function getJungler() {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
                     ->where('role_id', 2)
                     ->where('start_date', '<=', $today)
                     ->where('end_date', '>=', $today)
                     ->orderBy('start_date', 'desc');
    }
    public function getMidlaner() {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
                     ->where('role_id', 3)
                     ->where('start_date', '<=', $today)
                     ->where('end_date', '>=', $today)
                     ->orderBy('start_date', 'desc');
    }
    public function getADC() {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
                     ->where('role_id', 4)
                     ->where('start_date', '<=', $today)
                     ->where('end_date', '>=', $today)
                     ->orderBy('start_date', 'desc');
    }
    public function getSupport() {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
                     ->where('role_id', 5)
                     ->where('start_date', '<=', $today)
                     ->where('end_date', '>=', $today)
                     ->orderBy('start_date', 'desc');
    }
    public function checkForSubstitute($role_id, $today)
{
    $players = $this->players()->where('role_id', $role_id)
                               ->where('start_date', '<=', $today)
                               ->where(function ($query) use ($today) {
                                   $query->where('end_date', '>=', $today)
                                         ->orWhereNull('end_date');
                               })
                               ->orderBy('start_date', 'asc')
                               ->get();

    if ($players->count() > 1) {
        foreach ($players as $player) {
            $player->substitute = true;
            $player->save();
        }

        $latestPlayer = $players->last();
        $latestPlayer->substitute = false;
        $latestPlayer->save();
    }
}
}
