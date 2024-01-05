<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
    public function players()
    {
        return $this->belongsToMany(Player::class)->withPivot('start_date', 'contract_expiration_date', 'end_date', 'substitute');
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }
    public function competition()
    {
        return $this->belongsTo(Competition::class, 'league_id');
    }
    public function getPlayers()
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
            ->where('start_date', '<=', $today)
            ->where('end_date', '=', null)
            ->where('substitute', '=', false)
            ->orderBy('role_id', 'asc')
            ->get();
    }

    public function getPlayersDate($date)
    {
        return $this->players()
            ->where('start_date', '<=', $date)
            ->where('contract_expiration_date', '>=', $date)
            ->where(function ($query) use ($date) {
                $query->where('end_date', '>=', $date)
                    ->orWhereNull('end_date');
            })
            ->orderBy('role_id', 'asc')
            ->get();
    }
    public function getPlayersFromLastYear()
    {
        $date = \Carbon\Carbon::now()
            ->subYear()
            ->setMonth(12)
            ->setDay(30)
            ->toDateString();
        return $this->getPlayersDate($date);
    }
    public function getPlayersByYear($year)
{
    $startDate = \Carbon\Carbon::create($year, 1, 1);
    $endDate = \Carbon\Carbon::create($year, 12, 31);

    return $this->players()
        ->where('start_date', '<=', $endDate)
        ->where(function ($query) use ($startDate, $endDate) {
            $query->whereBetween('end_date', [$startDate, $endDate])
                ->orWhere(function ($query) use ($startDate, $endDate) {
                    $query->where('end_date', '>=', $endDate)
                        ->where('start_date', '<=', $startDate);
                });
        })
        ->orderBy('role_id', 'asc')
        ->get();
}
    public function getPlayersSubstitute()
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
            ->where(function ($query) use ($today) {
                $query->where('player_team.end_date', '>=', $today)
                    ->orWhereNull('player_team.end_date');
            })
            ->where('player_team.substitute', true)
            ->orderBy('role_id', 'asc')
            ->get();
    }
    public function getPastPlayers()
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
            ->where(function ($query) use ($today) {
                $query->where('player_team.end_date', '<', $today)
                    ->orWhere(function ($query) use ($today) {
                        $query->whereNull('player_team.end_date')
                            ->where('player_team.contract_expiration_date', '<', $today);
                    });
            })
            ->orderBy('player_team.end_date', 'desc')
            ->get();
    }
    public function getPlayersWithSameRole()
    {
        $today = Carbon::now()->format('Y-m-d');
        $roleIds = $this->players()
            ->where(function ($query) use ($today) {
                $query->where('end_date', '>=', $today)
                    ->orWhereNull('end_date');
            })
            ->pluck('role_id')
            ->duplicates();

        return $this->players()
            ->whereIn('role_id', $roleIds)
            ->orderBy('role_id', 'asc')
            ->get();
    }
    public function getToplaner()
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
            ->where('role_id', 1)
            ->where('start_date', '<=', $today)
            ->where(function ($query) use ($today) {
                $query->where('end_date', '>=', $today)
                    ->orWhereNull('end_date');
            })
            ->orderBy('start_date', 'desc');
    }

    //Estas aun no estan actualizadas

    public function getJungler()
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
            ->where('role_id', 2)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->orderBy('start_date', 'desc');
    }
    public function getMidlaner()
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
            ->where('role_id', 3)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->orderBy('start_date', 'desc');
    }
    public function getADC()
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
            ->where('role_id', 4)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->orderBy('start_date', 'desc');
    }
    public function getSupport()
    {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
            ->where('role_id', 5)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->orderBy('start_date', 'desc');
    }

    public function checksubstitute($date)
    {
        $date = Carbon::parse($date);

        $players = $this->players()->wherePivot('start_date', '<=', $date)
            ->where(function ($query) use ($date) {
                $query->where('end_date', '>=', $date)
                    ->orWhereNull('end_date');
            })->get();

        $grouped = $players->groupBy('role_id');
        foreach ($grouped as $roleId => $players) {

            $notSubstitutes = $players->where('pivot.substitute', false);

            if ($notSubstitutes->count() > 1) {

                $sorted = $notSubstitutes->sortByDesc(function ($player) {
                    return $player->pivot->start_date;
                });

                $latest = $sorted->shift();

                foreach ($sorted as $player) {
                    $player->pivot->substitute = true;
                    $player->pivot->save();
                }
            }
        }
    }
    public function hadFiveRolesLastYear()
    {
        $lastYearPlayers = $this->getPlayersFromLastYear();
        $roles = $lastYearPlayers->pluck('role_id')->unique();

        return count($roles) == 5;
    }
}
