@extends('layouts.master')

@section('page-title')
   {{__('admin.Edit City')}}
@endsection

@section('page-content')
<div class="card">

<div class="container card-body">
 <h1 class="text-center text-light bg-success"><i class="fa-solid fa-pen-to-square"></i> {{trans('admin.Edit City')}}</h1>
 <form action="{{route('cities.update',$city->id)}}" method="post" class="row">
    @csrf
    @method('PUT')
    <div class="form-group col-md-12">
      <label for="name">{{__('admin.City Name')}}</label>
      <input type="text" name="name" id="name" value="{{$city->name}}" class="form-control @error('name') is-invalid @enderror">
     
    </div>

     <div class="text-center">
        <button type="submit" class="btn btn-primary btn-lg">{{__('admin.Save Changes')}}</button>
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
