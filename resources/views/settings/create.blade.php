@extends('layouts.master')

@section('page-title')
  {{__('admin.New Setting')}}
@endsection

@section('page-content')

<div class="card">
   <div class="card-body">
    <h1 class="text-center bg-primary text-light"><i class="fa-solid fa-gear"></i> {{__('admin.Add New Setting')}}</h1>
    <form action="{{route('settings.store')}}" method="post" enctype="multipart/form-data" class="row">
     @csrf

    <div class="form-group col-md-12">
      <label for="logo">{{__('admin.Image')}}</label>
      <input type="file" name="logo" id="logo" class="form-control @error('image') is-invalid @enderror">
    </div>

    <div class="form-group col-md-12">
      <label for="email">{{__('admin.Email')}}</label>
      <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
    </div>

    <div class="form-group col-md-12">
      <label for="phone">{{__('admin.Phone')}}</label>
      <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror">
      </div>

    <div class="form-group col-md-12">
        <label for="location">{{__('admin.Location')}}</label>
        <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror">
    </div>

      <div class="text-center">
          <button type="submit" class="btn btn-primary btn-lg">{{__('admin.Add')}}</button>
          <button type="reset" class="btn btn-secondary btn-lg">{{__('admin.Reset')}}</button>
      </div>
</form>
</div>
</div>

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
   
@endsection
