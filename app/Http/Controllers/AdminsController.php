<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Traits\ResponseTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Redirect, Illuminate\Support\Facades\Response;


class AdminsController extends Controller
{
    use ResponseTrait;
     public function index()
    {
        $request=request();
        $users=User::when($request->query('name'),function ($query,$name){
            $query->where('name','LIKE','%'. $name .'%');
        })
            ->when($request->query('email'),function ($query,$email){
                $query->where('email','LIKE','%'. $email .'%');
            })
            ->paginate('10');
        return view('admins.index',compact('users'));
    }



    public function create()
    {
        return view('admins.create');
    }


    public function store(AdminRequest $request)
    {
        try {
            $data=$request->except('password');
            $data['password']=Hash::make($request->password);
            User::create($data);
            return redirect()->route('admins.index')->with('success',trans('Admins.created'));
        }catch (\Exception $exception){
           return $exception->getMessage();

       }
    }


    public function show(User $admin)
    {
        return view('admins.show',compact('admin'));
    }


    public function edit(User $admin)
    {
        return view('admins.edit',compact('admin'));
    }


    public function update(AdminRequest $request, User $admin)
    {
        try {
            $admin->update($request->all());
            return redirect()->route('admins.index')->with('success',trans('Admins.updated'));
        }catch (\Exception $exception){
            return redirect()->route('admins.index')->with('error',$exception->getMessage() );
        }
    }


    public function destroy(User $admin)
    {
        try {
            $admin->delete();
            return redirect()->route('admins.index')->with('success',trans('Admins.deleted'));
        }catch (\Exception $exception){
            return redirect()->route('admins.index')->with('error',$exception->getMessage() );
        }
    }
}
