<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
            'user_from' => new UserResource(User::query()->find($this->user_from)),
            'user_to' => new UserResource(User::query()->find($this->user_to))
        ];
    }
}
