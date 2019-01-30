<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $table = 'checklists';

    public function items()
    {
        return $this->hasMany('App\Item');
    }

    public function item()
    {
        return $this->hasOne('App\Item')->where('id', 1);
    }

}
