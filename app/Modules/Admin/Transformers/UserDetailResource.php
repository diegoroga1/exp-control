<?php

namespace Modules\Admin\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $array =  [
            'id' => $this->id,
            'name' => ucwords($this->name),
            'email' => $this->email,
            'created_at' => $this->created_at->format('d/m/Y'),
            'avatar' => $this->profile_photo_path,
            'permissions' => $this->permissions ? $this->permissions->toArray() : [],
            'roles' => $this->roles ? $this->roles->toArray() : [],
			'is_admin' => $this->isAdmin()
        ];
        return $array;
    }
}
