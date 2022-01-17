<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactPersonResource extends JsonResource
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
            'First Name' => $this->first_name,
            'Last Name' => $this->last_name,
            'Email' => $this->email,
            'Company Name' => $this->company->name,
            'Linkedin URL' => $this->linkedin_url,
        ];
    }
}
