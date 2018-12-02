<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Enums\PublishType;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    protected $perPage = 5;
    protected $fillable = ['name', 'status'];

    /**
     * Relations
     */

    public function shows()
    {
        return $this->hasMany(Show::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Attributes
     */

    public function getStatusNameAttribute()
    {
        return PublishType::getDescription($this->status);
    }

    /**
     * Model Properties
     */
    
    public function save(array $options = []) {

        // Delete old image if image is updated
        if ($this->isDirty('image')) {
            $path = $this->getOriginal('image');
            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        return parent::save($options);
    }
    
    public function delete()
    {
        $result = parent::delete();

        // Delete dependencies after removing item
        $path = $this->image;
        if ($result and isset($path)) {
            Storage::disk('public')->delete($path);
        }

        return $result;
    }

    /**
     * Helpers
     */

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
