<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Enums\EventStatusType;

class Event extends Model
{
    protected $fillable = ['name', 'status'];

    public function setStatusAttribute($value)
    {
        $this->attributes['status_code'] = EventStatusType::getValue($value);
    }

    public function getStatusAttribute()
    {
        return EventStatusType::getKey($this->status_code);
    }

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
        return $this->status_code == EventStatusType::Published;
    }
    
    public function scopePublished($query)
    {
        return $query->where('status_code', EventStatusType::Published);
    }
}
