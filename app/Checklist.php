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

}
