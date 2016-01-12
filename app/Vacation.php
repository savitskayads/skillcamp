<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    public function programs() {
        return $this->belongsToMany('App\Program','programs_vacations');
    }
}
