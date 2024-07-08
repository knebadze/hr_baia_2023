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
            'user' => $this->user ? $this->user->name_ka : null,
            'user_id' => $this->user_id,
            'user_number' => $this->user ? $this->user->number : null,
            'author' => $this->author ? $this->author->name_ka : null,
            'assigned' => $this->assignedUser ? $this->assignedUser->name_ka : null,
            'was_assigned_id' => $this->was_assigned_id,
            'was_assigned_parent_id' => $this->assignedUser->parent_id,
            'status' => $this->status ? $this->status->name_ka : null,
            'status_color' => $this->status ? $this->status->color : null,
            'status_id' => $this->status_id,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
