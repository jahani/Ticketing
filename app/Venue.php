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

    public function sections()
    {
        return $this->hasManyThrough(Section::class, Stage::class);
    }
}
