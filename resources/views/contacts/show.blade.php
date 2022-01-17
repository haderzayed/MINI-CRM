@extends('layouts.app')
@section('page-title',$ContactPerson->first_name)

@section('content')

    <div class="row">
    <div class="col-6 mb-3">
        <label for="exampleInputEmail1" class="form-label">{{trans('Contacts.first_name')}}</label>
        <input class="form-control" value="{{$ContactPerson->first_name}}" >
    </div>
    <div class="col-6 mb-3">
        <label for="exampleInputEmail1" class="form-label">{{trans('Contacts.last_name')}}</label>
        <input  class="form-control" value="{{$ContactPerson->last_name}}" >
    </div>
    </div>

    <div class="row">
    <div class="col-6 mb-3">
        <label for="exampleInputEmail1" class="form-label">{{trans('Contacts.email')}}</label>
        <input  class="form-control" value="{{$ContactPerson->email}}" >
    </div>
    <div class="col-6 mb-3">
        <label for="exampleInputEmail1" class="form-label">{{trans('Contacts.phone')}}</label>
        <input class="form-control" value="{{$ContactPerson->phone}}" >
    </div>
    </div>
    <div class="row">
        <div class="col-6 mb-3">
            <label for="exampleInputEmail1" class="form-label">{{trans('Contacts.linkedin_url')}}</label>
            <input  class="form-control" value="{{$ContactPerson->linkedin_url}}" >
        </div>
        <div class="col-6 mb-3">
            <label for="exampleInputEmail1" class="form-label">{{trans('Contacts.company')}}</label>
            <input  class="form-control" value="{{$ContactPerson->company->name}}" >
        </div>
    </div>


@endsection
