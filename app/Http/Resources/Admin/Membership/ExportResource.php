<?php

namespace App\Http\Resources\Admin\Membership;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'  => $this->resource->name,
            'email' => $this->resource->email,
            'password' => $this->resource->password,
        ];
    }
}