@extends('layouts.app')

@section('page-title',trans('Admins.admins'))
@section('css')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
     <button type="button" class="btn btn-success m-3" data-toggle="modal" id="create-admin" data-target="#formModal" data-whatever="@mdo">
        {{trans('Admins.add')}}</button>

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
        <form action="{{route('admins.index')}}" method="get"  class="form-check-inline"   >
            <input type="text" name="name"   class="form-control m-2 " placeholder="{{trans('Admins.search_name')}}">
            <input type="text" name="email" class="form-control m-2" placeholder="{{trans('Admins.search_email')}}" >

            <button type="submit" class="btn btn-primary"> {{trans('Companies.find')}} </button>
        </form>
    </div>
    <table class="table ">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{trans('Admins.name')}}</th>
            <th scope="col">{{trans('Admins.email')}}</th>
            <th scope="col">{{trans('Admins.role')}}</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php $i=0;?>
        @forelse($users as $user )
            <tr>
                <?php $i++;?>
                <td>{{$i}}</td>
                <td>{{$user->name}} </td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
                <td>
                    <button type="button" class="btn btn-info btn-sm fa fa-edit" data-target="#formModal" data-toggle="modal" onclick="editAdmin({{$user->id}})">
                    </button>
                    <a href="{{route('admins.show',$user->id)}}" class="btn btn-info btn-sm fa fa-eye" role="button" aria-pressed="true"> </a>
                    <form method="post" action="{{route('admins.destroy',$user->id)}}" class="d-inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger btn-sm fa fa-trash"></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">{{trans('Admins.no_admins')}}</td>
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


            $("#create-admin").click(function(event){

                $.ajax({
                    url: '{{route('admins.create')}}',
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

        function editAdmin(id){
            $.ajax({
                url:`{{url('/admins/${id}/edit')}}`,
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
