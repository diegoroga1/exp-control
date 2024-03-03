<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $array =  parent::toArray($request);
        $array["date"] = Carbon::parse($this->date)->format("d/m/Y");
        $array["amountCurrency"] = $this->amount ." ". $this->currency->symbol;
        $array["category"] = $this->category->name;
        $array["subcategory"] = $this->subcategory->name;

        return $array;
    }
}
