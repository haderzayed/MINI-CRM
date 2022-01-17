@extends('layouts.app')
@section('page-title','Admin page' )

@section('content')

<div class="row">
    <div class="col-8">
        <div class="col-8 mb-3">
            <label for="exampleInputEmail1" class="form-label">{{trans('Admins.name')}}</label>
            <input class="form-control" value="{{ $admin->name}}" >

        </div>

        <div class="col-8 mb-3">
            <label for="exampleInputEmail1" class="form-label">{{trans('Admins.email')}}</label>
            <input    class="form-control" value="{{ $admin->email }}" >
        </div>
        <div class="col-8 mb-3">
            <label for="exampleInputEmail1" class="form-label">{{trans('Admins.role')}}</label>
            <input   class="form-control" value="{{ $admin->role }}" >
        </div>
    </div>

</div>



@endsection
