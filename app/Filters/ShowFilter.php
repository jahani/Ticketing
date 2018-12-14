<?php


namespace App\Filters;

use Carbon\Carbon;


class ShowFilter extends Filter
{
    protected $filters = ['after', 'before'];

    public function after($value)
    {
        return $this->builder->where('start', '>=',
            Carbon::parse($value)->toDateTimeString()
        );
    }

    public function before($value)
    {
        return $this->builder->where('end', '<=',
            Carbon::parse($value)->toDateTimeString()
        );
    }
}
