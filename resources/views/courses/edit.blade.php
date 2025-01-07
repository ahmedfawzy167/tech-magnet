@extends('layouts.master')

@section('page-title')
    {{ __('admin.Edit Course') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center text-light bg-success"><i class="fa-solid fa-pen-to-square"></i> {{trans('admin.Edit Course')}}</h1></h1>
            <form action="{{ route('courses.update',$course->id) }}" method="POST" enctype="multipart/form-data" class="row">
                @csrf
                @method('PUT')
                <div class="form-group col-md-12">
                    <label for="name">{{ __('admin.Name') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="name" id="name" value="{{$course->name}}"
                        class="form-control @error('name') is-invalid @enderror">
                </div>

                <div class="form-group col-md-12">
                    <label for="description">{{ __('admin.Description') }}<span class="text-danger ms-2">*</span></label>
                    <textarea name="description" id="summernote"
                        class="form-control @error('description') is-invalid @enderror">{{ $course->description }}</textarea>
                </div>

                 <div class="form-group col-6">
                  <label for="price">{{__('admin.Price')}}<span class="text-danger ms-2">*</span></label>
                  <input type="text" name="price" id="price" value="{{ $course->price }}" class="form-control @error('price') is-invalid @enderror">  
                </div>

                <div class="form-group col-6">
                  <label for="hours">{{__('admin.Hours')}}<span class="text-danger ms-2">*</span></label>
                  <input type="text" name="hours" id="hours" value="{{ $course->hours }}" class="form-control @error('hours') is-invalid @enderror">
                </div>

              <div class="form-group col-12 mt-3">
               <label for="category_id">{{__('admin.Category')}}<span class="text-danger ms-2">*</span></label>
               <select name="category_id" id="category_id" class="select2 form-select @error('category_id') is-invalid @enderror">
                @foreach($categories as $category)
                  <option value="{{$category->id}}" {{ $category->id == $course->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                @endforeach
                </select>
              </div>

               <div class="form-group col-12 mt-3">
                <label for="roadmaps">{{__('admin.Roadmaps')}}<span class="text-danger ms-2">*</span></label>
                <select name="roadmaps[]" id="roadmaps" multiple class="form-select @error('roadmap_id') is-invalid @enderror">
                    @foreach($roadmaps as $roadmap)
                      <option value="{{$roadmap->id}}" {{ $course->roadmaps->contains($roadmap->id) ? 'selected' : '' }}>{{$roadmap->title}}</option>
                    @endforeach
                 </select>
               </div>

                <div class="form-group col-md-12">
                  <label for="image"> {{ __('admin.Image') }} <span class="text-muted">{{ (__('admin.(Optional)'))}}</span></label>
                    <input type="file" name="image" id="images"
                        class="form-control @error('image') is-invalid @enderror" onchange="previewImage(event)">
                        <img src="{{asset('storage/'.$course->image->path)}}" id="imagePreview" class="mt-3" style="max-width: 300px; height: auto;">
                </div>

                <div class="form-check">
                  <input type="checkbox" name="status" id="status" class="form-check-input" @checked($course->status->value === 1)>
                  <label for="status" class="form-check-label">{{ __('admin.Show on Website') }}</label>
                </div>
    
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('admin.Update') }}</button>
                    <button type="reset" class="btn btn-secondary btn-lg">{{ __('admin.Reset') }}</button>
                </div>

            </form>
        </div>
    </div>
    @endsection

@section('page-scripts')
  <script src="{{ asset('assets/js/imagePreview.js') }}"></script>
@endsection
    

