<?php

namespace Modules\Admin\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $array = [
            'id' => $this->id,
            'created_at' => $this->created_at->format('d/m/Y H:i:s'),
            'name' => $this->name,
            'description' => $this->description,
            'users' =>  $this->users->toArray(),
            'permissions' => $this->permissions->toArray(),
            'selected' => false
        ];

        return $array;
    }
}
