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
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror">
                </div>

                <div class="form-group col-md-12">
                    <label for="description"> {{ __('admin.Description') }}<span class="text-danger ms-2">*</span></label>
                    <textarea name="description" id="summernote"
                        class="form-control @error('description') is-invalid @enderror"></textarea>
                </div>

                 <div class="form-group col-6">
                   <label for="price">{{__('admin.Price')}}<span class="text-danger ms-2">*</span></label>
                   <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror">
                 </div>

                 <div class="form-group col-6">
                   <label for="hours">{{__('admin.Hours')}}<span class="text-danger ms-2">*</span></label>
                  <input type="text" name="hours" id="hours" class="form-control @error('hours') is-invalid @enderror">
                 </div>

              <div class="form-group col-12 mt-3">
               <label for="category_id">{{__('admin.Category')}}<span class="text-danger ms-2">*</span></label>
               <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror select2">
                   <option value="#" selected>Choose One..</option>
                @foreach($categories as $category)
                   <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
                </select>
              </div>

               <div class="form-group col-12 mt-3">
                <label for="roadmaps">{{__('admin.Roadmaps')}}<span class="text-danger ms-2">*</span></label>
                <select name="roadmaps[]" id="roadmaps" multiple class="form-select @error('roadmap_id') is-invalid @enderror">
                    @foreach($roadmaps as $roadmap)
                      <option value="{{$roadmap->id}}">{{$roadmap->title}}</option>
                    @endforeach
                 </select>
               </div>

                <div class="form-group col-md-12">
                    <label for="image"> {{ __('admin.Image') }} <span class="text-muted">{{ (__('admin.(Optional)'))}}</span></label>
                    <input type="file" name="image" id="image"
                        class="form-control @error('image') is-invalid @enderror" onchange="previewImage(event)">
                    <img id="imagePreview" class="mt-3" src="#" alt="Image Preview" style="display:none; max-width: 300px; height: auto;">
                </div>
                <div class="form-check ms-3">
                    <input type="checkbox" name="status" id="status" class="form-check-input" checked>
                    <label for="status" class="form-check-label">{{ __('admin.Show on Website') }}</label>
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
  <script src="{{ asset('assets/js/imagePreview.js') }}"></script>
@endsection
    

 
