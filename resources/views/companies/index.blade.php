@extends('layouts.app')

@section('page-title',trans('Companies.Companies'))

@section('content')
    <button type="button" class="btn btn-success m-3" data-toggle="modal" id="create-company" data-target="#formModal" data-whatever="@mdo">
        {{trans('Companies.add')}}</button>
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
    <table class="table table-bordered data-table" >
        <thead>
        <tr id="">
            <th scope="col">{{trans('Companies.logo')}}</th>
            <th scope="col"> {{trans('Companies.name')}}</th>
            <th scope="col">{{trans('Companies.email')}}</th>
            <th scope="col">{{trans('Companies.website_url')}}</th>
            <th width="280px">Action</th>

        </tr>
        </thead>
        <tbody>
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
    <script type="text/javascript">

        $(document).ready(function () {
            $(function () {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('companies.index') }}",
                columns: [
                   // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    // {data: 'id', name: 'id'},
                    { data: 'logo', name: 'logo'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'website_url', name: 'website_url'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

        });
            $("#create-company").click(function(event){

                $.ajax({
                    url: '{{route('companies.create')}}',
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
    </script>
@endsection

