<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'usertype' => $this->usertype,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'category' => $this->category,
            'logged_in' => $this->logged_in,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
