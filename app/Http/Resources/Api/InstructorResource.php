<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class InstructorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'    => (int) $this->id,
            'name'  => $this->first_name.$this->last_name,
            'image' => getFileLink('40x40', $this->images),
        ];
    }
}
