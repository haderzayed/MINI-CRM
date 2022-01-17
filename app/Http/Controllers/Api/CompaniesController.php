<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Notifications\CompanyCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Diff\Exception;

class CompaniesController extends Controller
{
    public function index()
    {
        $request = request();
        $companies = Company::when($request->query('name'), function ($query, $name) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        })
            ->when($request->query('email'), function ($query, $email) {
                $query->where('email', 'LIKE', '%' . $email . '%');
            })
            ->paginate('10');

        return CompanyResource::collection($companies);
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

                return new CompanyResource($company);

        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }
    public function show($id)
    {
        $company=Company::findOrFail($id);
        return new CompanyResource($company);
    }

    public function update(CompanyRequest $request, Company $company)
    {
        try {
            $old_logo = $company->logo;
            $data = $request->except('logo');
            $logo = $request->file('logo');
            if ($request->hasFile('logo') && $logo->isValid()) {
                $name = $logo->getClientOriginalName();
                $data['logo'] = $logo->storeAS('companies/' . $company->name, $name, 'public');
            }
            $company->update($data);
            if (isset($old_logo) && isset($data['logo'])) {
                Storage::disk('public')->delete($old_logo);
            }
                return new CompanyResource($company);
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function destroy(Company $company)
    {
        try{

            if($company->logo){
                Storage::deleteDirectory('/public/companies/'.$company->name);
            }
            $company->delete();
            return  "$company->name Company Deleted Successfully";
        }catch (\Exception $exception){
            return    $exception;
        }
    }
}
