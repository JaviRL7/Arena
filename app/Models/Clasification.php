<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Clasification extends Pivot
{
    public function champion(){
        return $this->belongsTo(Champion::class, 'champion_id');
    }
}
