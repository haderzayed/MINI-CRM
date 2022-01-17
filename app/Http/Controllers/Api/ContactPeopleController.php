<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactPersonRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\ContactPersonResource;
use App\Models\Company;
use App\Models\ContactPerson;
use Illuminate\Http\Request;

class ContactPeopleController extends Controller
{
    public function index()
    {
        $request=request();
        $contacts=ContactPerson::with('company')
            ->when($request->query('first_name'),function ($query,$first_name){
                $query->where('first_name','LIKE','%'. $first_name .'%');
            })
            ->when($request->query('last_name'),function ($query,$last_name){
                $query->where('last_name','LIKE','%'. $last_name .'%');
            })
            ->when($request->query('email'),function ($query,$email){
                $query->where('email','LIKE','%'. $email .'%');
            })
            ->when($request->query('phone'),function ($query,$phone){
                $query->where('phone','LIKE','%'. $phone .'%');
            })
            ->when($request->query('company_id'),function ($query,$company_id){
                $query->where('company_id','=', $company_id);
            })
            ->paginate('10');
       return  ContactPersonResource::collection($contacts);
      //  return $contacts;
    }

    public function store(ContactPersonRequest $request)
    {
        try {
          $ContactPerson=ContactPerson::create($request->all());

            return new ContactPersonResource($ContactPerson);
        }catch (\Exception $exception){
           return $exception;
        }
    }
    public function show(ContactPerson $ContactPerson)
    {
        return   new ContactPersonResource($ContactPerson);
    }
    public function update(ContactPersonRequest $request, ContactPerson $ContactPerson)
    {
        try {
            $ContactPerson->update($request->all());

            return   new ContactPersonResource($ContactPerson);
        }catch (\Exception $exception){
            return $exception;
        }
    }

    public function destroy(ContactPerson $ContactPerson)
    {
        try {
            $ContactPerson->delete();
            return "$ContactPerson->first_name Deleted Successfully";
        }catch (\Exception $exception){
            return $exception;
        }
    }

}
