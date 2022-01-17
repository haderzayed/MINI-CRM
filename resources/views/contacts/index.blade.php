@extends('layouts.app')

@section('page-title',trans('Contacts.contacts'))

@section('content')
     <button type="button" class="btn btn-success m-3" data-toggle="modal" id="create-contact" data-target="#formModal" data-whatever="@mdo">
        {{trans('Contacts.add')}}</button>
    <br><br>
     @if($errors->any())
         <div class="alert alert-danger">
             <ul>
                 @foreach($errors->all() as $error)
                     <li>{{$error}}</li>
                 @endforeach
             </ul>

         </div>
     @endif
     @include('alert.success')
     @include('alert.error')
    <br>
    <div class="bg-light p-1 mb-3">
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
    </div>
    <table class="table ">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{trans('Contacts.name')}}</th>
            <th scope="col">{{trans('Contacts.company')}}</th>
            <th scope="col">{{trans('Contacts.email')}}</th>
            <th scope="col">{{trans('Contacts.phone')}}</th>
            <th style="width:5px" scope="col">{{trans('Contacts.linkedin_url')}}</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php $i=0;?>
        @forelse($contacts as $contact )
            <tr>
                <?php $i++;?>
                <td>{{$i}}</td>
                    <td><a href="{{route('ContactPeople.show',$contact->id)}}"> {{$contact->first_name.' '.$contact->last_name}} </a> </td>
                <td>{{$contact->company->name}}</td>
                <td>{{$contact->email}}</td>
                <td>{{$contact->phone}}</td>
                <td ><a href="{{$contact->linkedin_url}}">{{$contact->linkedin_url}}</a></td>
                <td>
                    <button type="button" class="btn btn-info btn-sm fa fa-edit" data-target="#formModal" data-toggle="modal" onclick="editContact({{$contact->id}})">
                    </button>
                    <form method="post" action="{{route('ContactPeople.destroy',$contact->id)}}" class="d-inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger btn-sm fa fa-trash"></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">{{trans('Contacts.no_contacts')}}</td>
            </tr>
        @endforelse

        </tbody>
    </table>

     <!-- Modal -->

     <div class="modal" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content" id="variable_content">

             </div>
         </div>
     </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {


            $("#create-contact").click(function(event){

                $.ajax({
                    url: '{{route('ContactPeople.create')}}',
                    type:"get",
                    success:function(response){
                        $('#variable_content').html(response);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            });

        });

        function editContact(id){
            $.ajax({
                url:`{{url('/ContactPeople/${id}/edit')}}`,
                type:"get",
                success:function(response){
                    console.log(response);
                    $('#variable_content').html(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }


    </script>


@endsection
