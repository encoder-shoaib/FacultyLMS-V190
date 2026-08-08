<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MyBlogResource extends JsonResource
{
    public function toArray($request): array
    {

        return [
            'id'                => (int) $this->id,
            'thumbnail'         => getFileLink('402x248', $this->image),
            'title'             => $this->title,
            'slug'              => $this->slug,
            'short_description' => $this->short_description,
            'description'       => $this->description,
            'comments_count'    => $this->comments_count,
            'author'            => $this->user->user_type,
            'published_date'    => Carbon::parse($this->published_date)->format('d M Y'),
        ];
    }
}
