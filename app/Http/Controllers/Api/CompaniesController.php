<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Notifications\CompanyCreatedNotification;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Diff\Exception;

class CompaniesController extends Controller
{
    use ResponseTrait;
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
        $company=Company::find($id);
        if(!$company){
         return $this->returnError('this object not found',404);
        }
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
                $data['logo'] = $logo->storeAS('companies/'. $company->name, $name, 'public');
            }

            if (isset($old_logo) ) {

                Storage::deleteDirectory('/public/companies/'.$company->name);
            }
            $company->update($data);
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
