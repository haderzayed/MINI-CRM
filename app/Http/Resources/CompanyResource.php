<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'ID'         =>$this->id,
            'Company Name' => $this->name,
            'Company Email' => $this->email,
            'Company Website URL' => $this->website_url,
            'Company Logo' => $this->logo,
        ];
    }
}
