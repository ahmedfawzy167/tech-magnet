@extends('layouts.master')

@section('page-title')
    {{ __('admin.New Course') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center bg-primary text-white"><i class="ion-plus-circled"></i> {{ __('admin.Add New Course') }}</h1>
            <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="row">
                @csrf
                <div class="form-group col-md-12">
                    <label for="name"> {{ __('admin.Name') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror">
                </div>

                <div class="form-group col-md-12">
                    <label for="description"> {{ __('admin.Description') }}<span class="text-danger ms-2">*</span></label>
                    <textarea type="text" name="description" id="summernote"
                        class="form-control @error('description') is-invalid @enderror"></textarea>
                </div>

                 <div class="col-6">
                   <label for="price">{{__('admin.Price')}}<span class="text-danger ms-2">*</span></label>
                  <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror">
               </div>

                 <div class="col-6">
                   <label for="hours">{{__('admin.Hours')}}<span class="text-danger ms-2">*</span></label>
                  <input type="text" name="hours" id="hours" class="form-control @error('hours') is-invalid @enderror">
               </div>

              <div class="form-group col-12">
               <label for="category_id">{{__('admin.Category')}}<span class="text-danger ms-2">*</span></label>
               <select name="category_id" id="category_id" class="form-select">
                @foreach($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
                </select>
              </div>

              <div class="form-group col-12">
                <label for="objective_id">{{__('admin.Objectives')}}<span class="text-danger ms-2">*</span></label>
                <select name="objective_id" id="objective_id" class="form-select">
                 @foreach($objectives as $objective)
                   <option value="{{$objective->id}}">{{$objective->name}}</option>
                 @endforeach
                 </select>
               </div>

                <div class="form-group col-md-12">
                    <label for="images"> {{ __('admin.Image') }}<span class="text-danger ms-2">*</span></label>
                    <input type="file" name="image" id="images"
                        class="form-control @error('image') is-invalid @enderror">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('admin.Add') }}</button>
                    <button type="reset" class="btn btn-secondary btn-lg">{{ __('admin.Reset') }}</button>
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
