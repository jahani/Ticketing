<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = ['name'];

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
}
