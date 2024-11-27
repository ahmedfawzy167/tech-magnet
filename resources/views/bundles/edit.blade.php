@extends('layouts.master')

@section('page-title')
    {{ __('admin.Edit Bundle') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center bg-primary text-white"><i class="ion-plus-circled"></i> {{__('admin.Edit Bundle')}}</h1>
            <form action="{{ route('bundles.update',$bundle->id) }}" method="POST" class="row" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group col-12">
                    <label for="name"> {{ __('admin.Name') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="name" id="name" value="{{ $bundle->name }}" value="{{ $bundle->name }}"
                        class="form-control @error('name') is-invalid @enderror">
                </div>

                <div class="form-group col-md-12">
                    <label for="description"> {{ __('admin.Description') }}<span class="text-danger ms-2">*</span></label>
                    <textarea name="description" id="summernote"
                        class="form-control @error('description') is-invalid @enderror">{{ $bundle->description }}</textarea>
                </div>

                <div class="form-group col-12">
                    <label for="price"> {{ __('admin.Price') }}<span class="text-danger ms-2">*</span></label>
                    <input type="number" name="price" id="price" value="{{ $bundle->price }}" value="{{ $bundle->price }}"
                    class="form-control @error('price') is-invalid @enderror">
                </div>


                 <div class="form-group col-12">
                     <label for="courses">{{__('admin.Courses')}}<span class="text-danger ms-2">*</span></label><br>
                      <select name="courses[]" id="courses" class="form-select" multiple>
                        <option value="#"selected>Choose..</option>
                        @foreach ($courses as $course)
                        <option value="{{ $course->id }}" {{ $bundle->courses->contains($course->id) ? 'selected' : '' }}>
                            {{ $course->name }}
                         </option>
                        @endforeach
                      </select>
                 </div>

                 <div class="form-group col-md-12">
                    <label for="image"> {{ __('admin.Image') }}<span class="text-danger ms-2">*</span></label>
                    <input type="file" name="image" id="image" 
                        class="form-control @error('image') is-invalid @enderror" onchange="previewImage(event)">
                    <div class="invalid-feedback">Please Upload an Image</div>
                    <img src="{{asset('storage/'.$bundle->image->path)}}" id="imagePreview" class="mt-3" style="max-width: 300px; height: auto;">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('admin.Save Changes') }}</button>
                    <button type="reset" class="btn btn-secondary btn-lg">{{ __('admin.Reset') }}</button>
                </div>

            </form>
        </div>
    </div>
    @endsection


@section('page-scripts')
  <script src="{{ asset('assets/js/imagePreview.js') }}"></script>
@endsection

    

 