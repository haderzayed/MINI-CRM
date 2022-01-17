@extends('layouts.app')

@section('page-title',trans('Contacts.contacts'))

@section('content')
    <a  href="{{route('ContactPeople.create')}}" class="btn btn-success  " style="float: right">{{trans('Contacts.add')}}</a>
    <br><br>
     @include('alert.success')
     @include('alert.error')
    <br>
  {{--   <div class="bg-light p-1 mb-3">
        <form action="{{route('ContactPeople.index')}}" method="get"  class="form-check-inline" >
            <input type="text" name="first_name"   class="form-control m-2 " placeholder="{{trans('Contacts.search_last_name')}}" >
            <input type="text" name="last_name" class="form-control m-2" placeholder="{{trans('Contacts.search_first_name')}}" >
            <input type="text" name="email" class="form-control m-2" placeholder="{{trans('Contacts.search_email')}}" >
            <input type="text" name="phone" class="form-control m-2" placeholder="{{trans('Contacts.search_phone')}}" >
            <select name="company_id" class="form-control m-2"  >
                <option value="" selected>{{trans('Contacts.all_companies')}}</option>
                @foreach($companies as $company)
                    <option value="{{$company->id}}">{{$company->name}}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary"> {{trans('Contacts.find')}} </button>
        </form>
    </div>--}}

        <table class="table table-bordered data-table" >
            <thead>
            <tr id="">
                <th >{{trans('Contacts.ID')}}</th>
                <th >{{trans('Contacts.first_name')}}</th>
                <th >{{trans('Contacts.last_name')}}</th>
                <th >{{trans('Contacts.company')}}</th>
                <th >{{trans('Contacts.email')}}</th>
                <th >{{trans('Contacts.phone')}}</th>
                <th >{{trans('Contacts.linkedin_url')}}</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        </div>

@endsection

@section('js')
    <script type="text/javascript">

        $(document).ready(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ContactPeople.index') }}",
                columns: [
                    // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'id', name: 'id'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'company', name: 'company'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'linkedin_url', name: 'linkedin_url'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
    @endsection
