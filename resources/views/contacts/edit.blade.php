<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{trans('Contacts.edit')}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form method="post" action="{{route('ContactPeople.update',$ContactPerson->id)}}" >
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="row">
            <div class="col-6 mb-3">
                <label for="exampleInputEmail1" class="form-label">{{trans('Contacts.first_name')}}</label>
                <input type="text" name="first_name" class="form-control" value="{{old('first_name',$ContactPerson->first_name)}}" >
            </div>
            <div class="col-6 mb-3">
                <label for="exampleInputEmail1" class="form-label">{{trans('Contacts.last_name')}}</label>
                <input type="text" name="last_name" class="form-control" value="{{old('last_name',$ContactPerson->last_name)}}" >
            </div>
        </div>

        <div class="row">
            <div class="col-6 mb-3">
                <label for="exampleInputEmail1" class="form-label">{{trans('Contacts.email')}}</label>
                <input type="email" name="email" class="form-control" value="{{old('email',$ContactPerson->email)}}" >
            </div>
            <div class="col-6 mb-3">
                <label for="exampleInputEmail1" class="form-label">{{trans('Contacts.phone')}}</label>
                <input type="text" name="phone" class="form-control" value="{{old('phone',$ContactPerson->phone)}}" >
            </div>
        </div>

        <div class="col-6 mb-3">
            <label for="exampleInputEmail1" class="form-label">{{trans('Contacts.linkedin_url')}}</label>
            <input type="url" name="linkedin_url" class="form-control" value="{{old('linkedin_url',$ContactPerson->linkedin_url)}}" >
        </div>
        <div class="col-6 mb-3">
            <label for="exampleInputEmail1" class="form-label">{{trans('Contacts.company')}}</label>
            <select class="form-select form-control"  name="company_id" aria-label="Default select example">
                <option  value=" ">{{trans('Contacts.select_company')}}</option>
                @foreach($companies as $company)
                    <option value="{{$company->id}}" @if($company->id == $ContactPerson->company_id) selected @endif>{{old('name',$company->name)}}</option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="btn btn-primary">{{trans('Contacts.submit')}}</button>
    </form>
</div>



