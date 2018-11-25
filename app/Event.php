<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Enums\EventStatusType;

class Event extends Model
{
    protected $fillable = ['name', 'status'];

    public function shows()
    {
        return $this->hasMany(Show::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isPublished()
    {
        return $this->status == EventStatusType::Published;
    }
    
    public function scopePublished($query)
    {
        return $query->where('status', EventStatusType::Published);
    }
}
