<?php

namespace Modules\Admin\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
//       $array = parent::toArray($request);
       $array = [
           'id' => $this->id,
           'name' => $this->name,
           'email' => $this->email
       ];
       return $array;
    }
}
