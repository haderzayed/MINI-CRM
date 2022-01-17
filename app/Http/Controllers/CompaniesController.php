<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Notifications\CompanyCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Diff\Exception;
use Yajra\DataTables\Facades\DataTables;

class CompaniesController extends Controller
{

  /*  public function index()
    {
        $request=request();
        $companies=Company::when($request->query('name'),function ($query,$name){
                $query->where('name','LIKE','%'. $name .'%');
            })
            ->when($request->query('email'),function ($query,$email){
                $query->where('email','LIKE','%'. $email .'%');
            })
             ->paginate('10');

        return view('companies.index',compact('companies'));

    }*/
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Company::latest()->get();
            return Datatables::of($data)
              //  ->addIndexColumn()
                ->addColumn('logo', function ($data) {
                  return '<img src=" '.$data->logo.' " width="100px"/>';
                })
                ->addColumn('action', function($row){

                    $btn = '<a href="' . route('companies.edit', $row->id) .'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm showCompany">Edit</a>';

                    $btn = $btn.' <a href="' . route('companies.show', $row->id) .'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Show" class="btn btn-primary btn-sm showCompany">Show</a>';


                    return $btn;
                })
                ->rawColumns(['logo','action'])
                ->make(true);
        }

        return view('companies.index');
    }


    public function create()
    {
        return view('companies.create');
    }


    public function store(CompanyRequest $request)
    {
        try{
            $data=$request->except('logo');
            $logo=$request->file('logo');
            if ($request->hasFile('logo') && $logo->isValid()){
                $name=$logo->getClientOriginalName();
                $data['logo']=$logo->storeAS('companies/'.$request->name,$name,'public');
            }
            $company= Company::create($data);
            Notification::send($company,new CompanyCreatedNotification( $company));
            if($request->wantsJson()){
                return new CompanyResource($company);
            }

            return redirect()->route('companies.index')->with('success',trans('Companies.created'));

        }catch (\Exception $exception){
            return redirect()->route('companies.index')->with('error',$exception->getMessage() );
        }

    }


    public function show($id)
    {
       $company=Company::findOrFail($id);

       return view('companies.show',compact('company'));
    }


    public function edit(Company $company)
    {

        return view('companies.edit',compact('company'));
    }


    public function update(CompanyRequest $request, Company $company)
    {
        try{
            $old_logo=$company->logo;
            $data=$request->except('logo');
            $logo=$request->file('logo');

            if(isset($old_logo) && isset($logo)){
                Storage::deleteDirectory('/public/companies/'.$company->name);
                $name=$logo->getClientOriginalName();
                $data['logo']=$logo->storeAS('companies/'.$company->name,$name,'public');
            }
            
            $company->update($data);

            return redirect()->route('companies.index')->with('success',trans('Companies.updated'));
        }catch (Exception $exception){
            return redirect()->route('companies.index')->with('error',$exception->getMessage());
        }
    }


    public function destroy(Company $company)
    {
        try{
            if($company->logo){
                Storage::deleteDirectory('/public/companies/'.$company->name);
            }
           $company->delete();
            return redirect()->route('companies.index')->with('success',trans('Companies.deleted'));
        }catch (\Exception $exception){
            return redirect()->route('companies.index')->with('error',$exception->getMessage());
        }

    }
}
