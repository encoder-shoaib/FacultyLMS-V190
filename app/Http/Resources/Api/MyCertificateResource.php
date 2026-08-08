<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class MyCertificateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                      => (int) $this->id,
            'title'                   => $this->title,
            'body'                    => $this->body,
            'instructor_signature'    => getFileLink('170x74', $this->instructor_signature),
            'logo'                    => getFileLink('84x85', $this->background_image),
            'administrator_signature' => getFileLink('170x74', $this->administrator_signature),
            'certificate_top'         => static_asset('frontend/certificate/certificate-top.png'),
            'certificate_border'      => static_asset('frontend/certificate/certificate-border.png'),
        ];
    }
}
