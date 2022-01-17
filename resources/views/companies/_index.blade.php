@extends('layouts.app')

@section('page-title',trans('Companies.Companies'))

@section('content')
    <a  href="{{route('companies.create')}}" class="btn btn-success  " style="float: right">{{trans('Companies.add')}}</a>
    <br><br>
     @include('alert.success')
     @include('alert.error')
    <br>
    <div class="bg-light p-1 mb-3">
        <form action="{{route('companies.index')}}" method="get"  class="form-check-inline"   >
            <input type="text" name="name"   class="form-control m-2 " placeholder="{{trans('Companies.search_name')}}">
            <input type="text" name="email" class="form-control m-2" placeholder="{{trans('Companies.search_email')}}" >

            <button type="submit" class="btn btn-primary"> {{trans('Companies.find')}} </button>
        </form>
    </div>
    <table class="table ">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{trans('Companies.logo')}}</th>
            <th scope="col"> {{trans('Companies.name')}}/th>
            <th scope="col">{{trans('Companies.email')}}</th>
            <th scope="col">{{trans('Companies.website_url')}}</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php $i=0;?>
        @forelse($companies as $company )
            <tr>
                <?php $i++;?>
                <td>{{$i}}</td>
                <td><img style="width: 150px; height: 100px;" src="{{$company->logo_url}}"></td>
                    <td><a href="{{route('companies.show',$company->id)}}">{{$company->name}} </a></td>
                <td>{{$company->email}}</td>
                <td><a href="{{$company->website_url}}">{{$company->website_url}}</a> </td>
                <td>
                    <a href="{{route('companies.edit',$company->id)}}" class="btn btn-info btn-sm fa fa-edit" role="button" aria-pressed="true"> </a>
                     <form method="post" action="{{route('companies.destroy',$company->id)}}" class="d-inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger btn-sm fa fa-trash"></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">{{trans('Companies.no_companies')}}</td>
            </tr>
        @endforelse

        </tbody>
    </table>
@endsection
