@extends('layouts.master')

@section('page-title')
{{__('admin.New Blog')}}
@endsection

@section('page-content')

 <div class="card">
    <div class="card-body">
     <h1 class="text-center bg-primary text-white mt-3"><i class="ion-plus-circled"></i> {{__('admin.Add New Blog')}}</h1>
     <form action="{{ route('blogs.store') }}" method="post" class="row" enctype="multipart/form-data">
      @csrf

      <div class="form-group col-12 mt-3">
       <label for="title"><i class="fa-solid fa-file-signature"></i> {{__('admin.Title')}}</label>
       <input type="text" name="title" id="title" class="form-control mt-2 @error('title') is-invalid @enderror">
      </div>

       <div class="form-group col-md-12">
          <label for="description"><i class="ion-ios-albums"></i> {{ __('admin.Description') }}</label>
          <textarea name="description" id="summernote"
            class="form-control @error('description') is-invalid @enderror"></textarea>
      </div>
      <div class="form-group col-md-12">
        <label for="images"><i class="ion-images"></i> {{ __('admin.Image') }}<span class="text-danger ms-2">*</span></label>
        <input type="file" name="image" id="images"
          class="form-control @error('image') is-invalid @enderror">
          <div class="invalid-feedback">
            Please Upload an Image
          </div>
    </div>
      <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary btn-lg">{{__('admin.Add')}}</button>
        <button type="reset" class="btn btn-secondary btn-lg">{{__('admin.Reset')}}</button>
      </div>

</form>
</div>
</div>
@endsection


@section('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
         toastr.options = {
        "closeButton": false,
        "debug": false,
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "500",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "toastClass": "bg-danger text-white"
    }
    </script>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
          <script>
              toastr.error('{{ $error }}');
          </script>
        @endforeach

    @endif

   @endsection

