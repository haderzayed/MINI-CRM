@extends('layouts.app')
@section('page-title',trans('Companies.edit'))

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>

        </div>
    @endif
<form method="post" action="{{route('companies.update',$company->id)}}"   enctype="multipart/form-data">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <div class="col-6 mb-3">
        <label for="exampleInputEmail1" class="form-label">{{trans('Companies.name')}}</label>
        <input type="text" name="name" class="form-control" value="{{old('name',$company->name)}}" >

    </div>

    <div class="col-6 mb-3">
        <label for="exampleInputEmail1" class="form-label">{{trans('Companies.email')}}</label>
        <input type="email" name="email" class="form-control" value="{{old('email',$company->email)}}" >
    </div>
    <div class="col-6 mb-3">
        <label for="exampleInputEmail1" class="form-label">{{trans('Companies.website_url')}}</label>
        <input type="url" name="website_url" class="form-control" value="{{old('website_url',$company->website_url)}}" >
    </div>

    <div class="col-6 mb-3">
        <label for="exampleInputEmail1" class="form-label">{{trans('Companies.logo')}}</label>
        <input type="file" name="logo" value="{{old('logo')}}" class="form-control"  >
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
