<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname1',
        'lastname2',
        'nick',
        'country',
        'role_id',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
