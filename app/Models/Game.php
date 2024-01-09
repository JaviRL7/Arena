<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'ban1_blue_id', 'ban2_blue_id', 'ban3_blue_id', 'ban4_blue_id', 'ban5_blue_id',
        'ban1_red_id', 'ban2_red_id', 'ban3_red_id', 'ban4_red_id', 'ban5_red_id',

    ];

    public function serie() {
        return $this->belongsTo(Serie::class, 'serie_id');
    }
    public function team_blue() {
        return $this->belongsTo(Team::class, 'team_blue_id');
    }
    public function team_red() {
        return $this->belongsTo(Team::class, 'team_red_id');
    }
    public function ban1_blue()
    {
        return $this->belongsTo(Champion::class, 'ban1_blue');
    }
    public function ban2_blue()
    {
        return $this->belongsTo(Champion::class, 'ban2_blue');
    }
    public function ban3_blue()
    {
        return $this->belongsTo(Champion::class, 'ban3_blue');
    }
    public function ban4_blue()
    {
        return $this->belongsTo(Champion::class, 'ban4_blue');
    }
    public function ban5_blue()
    {
        return $this->belongsTo(Champion::class, 'ban5_blue');
    }
    public function ban1_red()
    {
        return $this->belongsTo(Champion::class, 'ban1_red');
    }
    public function ban2_red()
    {
        return $this->belongsTo(Champion::class, 'ban2_red');
    }
    public function ban3_red()
    {
        return $this->belongsTo(Champion::class, 'ban3_red');
    }public function ban4_red()
    {
        return $this->belongsTo(Champion::class, 'ban4_red');
    }public function ban5_red()
    {
        return $this->belongsTo(Champion::class, 'ban5_red');
    }


    public function players()
    {
        return $this->belongsToMany(Player::class, 'clasifications')->withPivot('kills', 'deaths', 'assists', 'champion_id');
    }

    public function getPlayerStats(Player $player) {
        return $this->players()->where('player_id', $player->id)->first()->pivot->only(['kill', 'deaths', 'assists']);
    }
    public function champion(){
        return $this->belongsTo(Champion::class, 'champion_id');
    }
    public function attachPlayers($results_blue, $results_red, $bans = null) {
        $team_blue_id = $this->team_blue_id;
        $team_red_id = $this->team_red_id;

        $players_team_blue = Player::whereHas('teams', function ($query) use ($team_blue_id) {
            $query->where('id', $team_blue_id);
        })->orderBy('role_id', 'asc')->get();

        $players_team_red = Player::whereHas('teams', function ($query) use ($team_red_id) {
            $query->where('id', $team_red_id);
        })->orderBy('role_id', 'asc')->get();

        foreach ($players_team_blue as $index => $player) {
            $champion_name = strtolower($results_blue[$index]['champion_name']);
            $champion = Champion::whereRaw('lower(name) = ?', $champion_name)->first();
            if ($champion) {
                $results_blue[$index]['champion_id'] = $champion->id;
            }
            unset($results_blue[$index]['champion_name']);
            $player->games()->attach($this->id, $results_blue[$index]);
        }

        foreach ($players_team_red as $index => $player) {
            $champion_name = strtolower($results_red[$index]['champion_name']);
            $champion = Champion::whereRaw('lower(name) = ?', $champion_name)->first();
            if ($champion) {
                $results_red[$index]['champion_id'] = $champion->id;
            }
            unset($results_red[$index]['champion_name']);
            $player->games()->attach($this->id, $results_red[$index]);
        }
        if ($bans !== null) {
            for ($i = 0; $i < 10; $i++) {
                $champion_name = strtolower($bans[$i]);
                $champion = Champion::whereRaw('lower(name) = ?', $champion_name)->first();
                if ($champion) {
                    $ban_column = 'ban' . ($i % 5 + 1) . '_' . ($i < 5 ? 'blue' : 'red');
                    $this->$ban_column = $champion->id;
                }
            }
        }

        $this->save();
    }


    public function clasifications()
    {
        return $this->hasMany(Clasification::class);
    }




    //Relacion muchos a muchos para la tabla scores
    public function users(){
        return $this->belongsToMany(User::class, 'scores')->withPivot('player_id', 'nota');
    }
    public function comments()
{
    return $this->hasMany(Comment::class);
}
}

