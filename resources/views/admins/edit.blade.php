
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>

        </div>
    @endif
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{trans('Admins.add')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form method="post" action="{{route('admins.update',$admin->id)}}"  >
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            <div class="col-6 mb-3">
                <label for="exampleInputEmail1" class="form-label">{{trans('Admins.name')}}</label>
                <input type="text" name="name" class="form-control" value="{{old('name',$admin->name)}}" >

            </div>
            <div class="col-6 mb-3">
                <label for="exampleInputEmail1" class="form-label">{{trans('Admins.email')}}</label>
                <input type="email" name="email" class="form-control" value="{{old('email',$admin->email)}}" >
            </div>

            <div class="m-4">
                <div class="form-check">
                    <input name="role" value="super_admin" class="form-check-input" type="radio"   id="flexRadioDefault1"
                           @if($admin->role=='super_admin') checked @endif>
                    <label class="form-check-label" for="flexRadioDefault1">
                        {{trans('Admins.super_admin')}}
                    </label>
                </div>
                <div class="form-check">
                    <input name="role" value="sub_admin" class="form-check-input" type="radio"  id="flexRadioDefault2"
                           @if($admin->role=='sub_admin') checked @endif>
                    <label class="form-check-label" for="flexRadioDefault2">
                        {{trans('Admins.sub_admin')}}
                    </label>
                </div>
            </div>


            <button type="submit" class="btn btn-primary">{{trans('Admins.submit')}}</button>
        </form>
    </div>


