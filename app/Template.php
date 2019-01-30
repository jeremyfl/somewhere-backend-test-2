<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'templates';

    public function checklists()
    {
        return $this->hasMany('App\Checklist');
    }
}
