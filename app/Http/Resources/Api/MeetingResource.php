<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MeetingResource extends JsonResource
{
    public function toArray($request): array
    {
        if ($this->liveClass->meeting_method == 'zoom') {
            $joinLink = $this->liveClass->meeting_link['zoom']['join_url'];
        } else {
            $joinLink = $this->liveClass->meeting_link['google_meet']['join_url'];
        }

        return [
            'id'               => (int) $this->id,
            'thumbnail'        => getFileLink('402x248', $this->image),
            'title'            => $this->title,
            'meeting_method'   => $this->liveClass->meeting_method,
            'meeting_type'     => $this->liveClass->meeting_type,
            'meeting_interval' => $this->liveClass->meeting_interval,
            'days'             => $this->liveClass->days,
            'start_date'       => Carbon::parse($this->liveClass->start_time)->format('d M y'),
            'start_time'       => Carbon::parse($this->liveClass->start_time)->format('h:i A'),
            'end_time'         => $this->liveClass->end_time,
            'duration'         => $this->liveClass->duration,
            'join_link'        => $joinLink,
        ];
    }
}
