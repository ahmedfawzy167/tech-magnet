@extends('layouts.master')

@section('page-title')
   {{__('New Material')}}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center bg-primary text-white"><i class="ion-plus-circled"></i>    {{__('New Material')}}</h1>
            <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data" class="row">
                @csrf
                <div class="form-group col-md-12">
                    <label for="title"> {{ __('admin.Title') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="form-control @error('title') is-invalid @enderror">
                </div>

                <div class="form-group col-md-12">
                    <label for="description"> {{ __('admin.Description') }}<span class="text-danger ms-2">*</span></label>
                    <textarea name="description" id="summernote"
                        class="form-control @error('description') is-invalid @enderror"></textarea>
                </div>

                <div class="form-group col-md-12">
                    <label for="file">File <span class="text-danger ms-2">*</span></label>
                    <input type="file" name="file" id="file"
                        class="form-control @error('file') is-invalid @enderror">
                        <div class="invalid-feedback">
                            Please Upload a File
                        </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="file_type">file_type<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="file_type" id="file_type" value="{{ old('file_type') }}"
                        class="form-control @error('file_type') is-invalid @enderror">
               </div>
              <div class="form-group col-12">
               <label for="course_id">{{__('admin.Course')}}<span class="text-danger ms-2">*</span></label>
               <select name="course_id" id="course_id" class="form-select">
                @foreach($courses as $course)
                  <option value="{{$course->id}}">{{$course->name}}</option>
                @endforeach
                </select>
              </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('admin.Add') }}</button>
                    <button type="reset" class="btn btn-secondary btn-lg">{{ __('admin.Reset') }}</button>
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

