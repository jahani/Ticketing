<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'status'];

    public function shows()
    {
        return $this->hasMany(Show::class);
    }
}
