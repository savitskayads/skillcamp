<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public function vacations() {
        return $this->belongsToMany('App\Vacation','programs_vacations');
    }
}
