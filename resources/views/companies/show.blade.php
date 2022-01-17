@extends('layouts.app')
@section('page-title',$company->name .' Company' )

@section('content')

<div class="row">
    <div class="col-8">
        <div class="col-8 mb-3">
            <label for="exampleInputEmail1" class="form-label">{{trans('Companies.name')}}</label>
            <input class="form-control"  value="{{ $company->name}}" >

        </div>

        <div class="col-8 mb-3">
            <label for="exampleInputEmail1" class="form-label">{{trans('Companies.email')}}</label>
            <input    class="form-control" value="{{ $company->email }}" >
        </div>
        <div class="col-8 mb-3">
            <label for="exampleInputEmail1" class="form-label">{{trans('Companies.website_url')}}</label>
            <input   class="form-control" value="{{ $company->website_url }}" >
        </div>
    </div>
    <div class="col-4">
        <div class="col-12 mb-3  ">
            <label for="exampleInputEmail1" class="form-label">{{trans('Companies.logo')}}</label>
            <img src="{{asset($company->logo)}}" height="150"  alt=" " class="d-block m-2 pr-3">
        </div>
    </div>
</div>

<form method="post" action="{{route('companies.destroy',$company->id)}}" class="d-inline">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <button class="btn btn-danger btn-sm ">Delete this company </button>
</form>



@endsection
