<?php

namespace Modules\Admin\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $array = parent::toArray($request);
        $array['id'] = $this->id;
        $array['users'] = $this->users ? $this->users->toArray() : [];
        return $array;
    }
}
