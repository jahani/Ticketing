<?php


namespace App\Filters;

class EventFilter extends Filter
{
    protected $filters = ['image', 'status'];

    public function image()
    {
        return $this->builder->whereNotNull('image');
    }

    public function status($value)
    {
        return $this->builder->where('status', $value);
    }
}
