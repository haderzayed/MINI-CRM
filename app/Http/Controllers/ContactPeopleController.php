<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactPersonRequest;
use App\Models\Company;
use App\Models\ContactPerson;
use Illuminate\Http\Request;
use SebastianBergmann\Diff\Exception;
use Yajra\DataTables\Facades\DataTables;

class ContactPeopleController extends Controller
{

    public function index()
    {
        $request=request();
        $companies=Company::all();
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

        return view('contacts.index',compact('contacts','companies'));
    }


    public function create()
    {
        $companies=Company::all();
        return view('contacts.create',compact('companies'));
    }


    public function store(ContactPersonRequest $request)
    {
        try {
            ContactPerson::create($request->all());
            return redirect()->route('ContactPeople.index')->with('success',trans('Contacts.created'));
        }catch (\Exception $exception){
            return redirect()->route('ContactPeople.index')->with('error',$exception->getMessage() );
        }
    }


    public function show(ContactPerson $ContactPerson)
    {
        return view('contacts.show',compact('ContactPerson'));
    }

    public function edit(ContactPerson $ContactPerson)
    {
        $companies=Company::all();
        return view('contacts.edit',compact('ContactPerson','companies'));
    }


    public function update(ContactPersonRequest $request, ContactPerson $ContactPerson)
    {
        try {
            $ContactPerson->update($request->all());
            return redirect()->route('ContactPeople.index')->with('success',trans('Contacts.updated'));
        }catch (\Exception $exception){
            return redirect()->route('ContactPeople.index')->with('error',$exception->getMessage() );
        }
    }


    public function destroy(ContactPerson $ContactPerson)
    {
        try {
            $ContactPerson->delete();
            return redirect()->route('ContactPeople.index')->with('success',trans('Contacts.deleted'));
        }catch (\Exception $exception){
            return redirect()->route('ContactPeople.index')->with('error',$exception->getMessage() );
        }
    }
}
