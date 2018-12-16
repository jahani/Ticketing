<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Enums\PublishType;

class ShowEventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'start' => $this->start->toDateTimeString(),
            'end' => $this->end->toDateTimeString(),
            'event' => [
                'id' => $this->event->id,
                'name' => $this->event->name,
                'description' => str_limit($this->event->description),
                'image' => $this->event->getImageURL(),
                'status' => PublishType::getDescription($this->event->status),
                'user_id' => $this->event->user_id,
            ],
            'venues' => $this->venues(),
        ];
    }
}
