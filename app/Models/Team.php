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
    public function getPlayers() {
        $today = Carbon::now()->format('Y-m-d');
        return $this->players()
                    ->where('start_date', '<=', $today)
                     ->where('end_date', '>=', $today)
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
}
