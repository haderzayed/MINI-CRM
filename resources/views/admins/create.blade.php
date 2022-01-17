
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{trans('Admins.add')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{route('admins.store')}}"  >
                @csrf
                <div class="row">
                    <div class="col-6 mb-3">
                        <label for="exampleInputEmail1" class="form-label">{{trans('Admins.name')}}</label>
                        <input type="text" name="name" class="form-control" value="{{old('name')}}" >

                    </div>
                    <div class="col-6 mb-3">
                        <label for="exampleInputEmail1" class="form-label">{{trans('Admins.email')}}</label>
                        <input type="email" name="email" class="form-control" value="{{old('email')}}" >

                    </div>
                </div>
                <div class="row">

                    <div class="col-6 mb-3">
                        <label for="exampleInputEmail1" class="form-label">{{trans('Admins.password')}}</label>
                        <input type="password" name="password" class="form-control" value="{{old('password')}}" >

                    </div>
                    <div class="col-6 mb-3">
                        <label for="exampleInputEmail1" class="form-label">{{trans('Admins.password_confirmation')}}</label>
                        <input type="password"  name="password_confirmation" class="form-control" value="{{old('password')}}" >

                    </div>
                </div>

                <div class="m-4">
                    <div class="form-check">
                        <input name="role" value="super_admin" class="form-check-input" type="radio"   id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">

                            {{trans('Admins.super_admin')}}
                        </label>
                    </div>
                    <div class="form-check">
                        <input name="role" value="sub_admin" class="form-check-input" type="radio"  id="flexRadioDefault2" checked>

                        <label class="form-check-label" for="flexRadioDefault2">
                            {{trans('Admins.sub_admin')}}
                        </label>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="save-data" class="btn btn-primary">{{trans('Admins.submit')}}</button>
            </div>
            </form>
        </div>

