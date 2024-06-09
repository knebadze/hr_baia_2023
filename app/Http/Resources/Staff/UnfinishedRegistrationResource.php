<?php

namespace App\Http\Resources\Staff;

use Illuminate\Http\Resources\Json\JsonResource;

class UnfinishedRegistrationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => $this->user->name_ka,
            'user_id' => $this->user_id,
            'user_number' => $this->user->number,
            'author' => $this->author->name_ka,
            'assigned' => $this->assignedUser->name_ka,
            'was_assigned_id' => $this->was_assigned_id,
            'status' => $this->status->name_ka,
            'status_color' => $this->status->color,
            'status_id' => $this->status_id,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
