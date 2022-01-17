<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{trans('Companies.add')}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form method="post" action="{{route('companies.store')}}"   enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6 mb-3">
                <label for="exampleInputEmail1" class="form-label">{{trans('Companies.name')}}</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}" >

            </div>

            <div class="col-6 mb-3">
                <label for="exampleInputEmail1" class="form-label">{{trans('Companies.email')}}</label>
                <input type="email" name="email" class="form-control" value="{{old('email')}}" >
            </div>
        </div>

        <div class="row">
            <div class="col-6 mb-3">
                <label for="exampleInputEmail1" class="form-label">{{trans('Companies.website_url')}}</label>
                <input type="url" name="website_url" class="form-control" value="{{old('website_url')}}" >
            </div>

            <div class="col-6 mb-3">
                <label for="exampleInputEmail1" class="form-label">{{trans('Companies.logo')}}</label>
                <input type="file" name="logo" value="{{old('logo')}}" class="form-control"   >
            </div>
        </div>



        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


</div>


