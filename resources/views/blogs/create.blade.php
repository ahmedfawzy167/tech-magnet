@extends('layouts.master')

@section('page-title')
   {{__('admin.New Blog')}}
@endsection

@section('page-head')
  {{-- <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
  <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"> --}}
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
        <label for="image"><i class="ion-images"></i> {{ __('admin.Image') }}<span class="text-danger ms-2">*</span></label>
        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" onchange="previewImage(event)">
        <img id="imagePreview" class="mt-3" src="#" alt="Image Preview" style="display:none; max-width: 300px; height: auto;">
      
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
  <script src="{{ asset('assets/js/imagePreview.js') }}"></script>
@endsection


