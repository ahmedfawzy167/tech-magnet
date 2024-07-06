@extends('layouts.master')

@section('page-title')
{{__('admin.New Blog')}}
@endsection

@section('page-content')

 <div class="card">
    <div class="card-body container">
     <h1 class="text-center bg-primary text-white mt-3"><i class="ion-plus-circled"></i> {{__('admin.Add New Blog')}}</h1>
     <form action="{{ route('blogs.store') }}" method="post" class="row" enctype="multipart/form-data">
      @csrf

      <div class="form-group col-12 mt-3">
       <label for="title"><i class="fa-solid fa-file-signature"></i> {{__('admin.Title')}}</label>
       <input type="text" name="title" id="title" class="form-control mt-2 @error('title') is-invalid @enderror">
       @error('title')
        <strong class="invalid-feedback">{{ $message }}</strong>
       @enderror
      </div>

       <div class="form-group col-md-12">
          <label for="description"><i class="ion-ios-albums"></i> {{ __('admin.Description') }}</label>
          <textarea type="text" name="description" id="summernote"
                        class="form-control @error('description') is-invalid @enderror"></textarea>
          @error('description')
                <strong class="invalid-feedback" role="alert">{{ $message }}</strong>
          @enderror
      </div>
      <div class="form-group col-md-12">
        <label for="images"><i class="ion-images"></i> {{ __('admin.Image') }}<span class="text-danger ms-2">*</span></label>
        <input type="file" name="image" id="images"
            class="form-control @error('image') is-invalid @enderror">
        @error('image')
            <strong class="invalid-feedback" role="alert">{{ $message }}</strong>
        @enderror
    </div>

      <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary btn-lg">{{__('admin.Add')}}</button>
        <button type="reset" class="btn btn-secondary btn-lg">{{__('admin.Reset')}}</button>
       </div>

</form>
</div>
</div>

@endsection
