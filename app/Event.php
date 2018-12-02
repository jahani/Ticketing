<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Enums\PublishType;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    protected $perPage = 5;
    protected $fillable = ['name', 'status'];

    public function getStatusNameAttribute()
    {
        return PublishType::getDescription($this->status);
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
        return $this->status == PublishType::Published;
    }
    
    public function scopePublished($query)
    {
        return $query->where('status', PublishType::Published);
    }

    public function getImageURL()
    {
        return isset($this->image) ? url(Storage::url($this->image)) : asset('img/default.png');
    }
}
