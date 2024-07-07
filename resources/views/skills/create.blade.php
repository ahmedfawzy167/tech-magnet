@extends('layouts.master')

@section('page-title')
    {{ __('admin.Add New Skill') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center bg-primary text-white"><i class="ion-plus-circled"></i> {{ __('admin.Add New Skill') }}</h1>
            <form action="{{ route('skills.store') }}" method="POST" class="row">
                @csrf
                <div class="form-group col-md-12">
                    <label for="title"> {{ __('admin.Name') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="title" id="title"
                        class="form-control @error('title') is-invalid @enderror">
                    
                </div>

                <div class="form-group col-md-12">
                    <label for="content">{{ __('admin.Content') }}<span class="text-danger ms-2">*</span></label>
                    <textarea type="text" name="content"
                        class="form-control @error('content') is-invalid @enderror"></textarea>
                    
                </div>
                 
              <div class="form-group col-12">
               <label for="super_skill_id">{{__('admin.Super Skills')}}<span class="text-danger ms-2">*</span></label>
               <select name="super_skill_id" id="super_skill_id" class="form-select">
                @foreach($super_skills as $super_skill)
                  <option value="{{$super_skill->id}}">{{$super_skill->name}}</option>
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
