@extends('layouts.master')

@section('page-title')
  {{__('admin.Edit Blog')}}
@endsection


@section('page-content')

 <div class="card">
    <div class="card-body">
      <h1 class="text-center text-light bg-success"><i class="fa-solid fa-pen-to-square"></i> {{trans('admin.Edit Blog')}}</h1>
      <form action="{{ route('blogs.update',$blog->id) }}" method="post" class="row" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      
      <div class="form-group col-12 mt-3">
       <label for="title">{{__('admin.Title')}}<span class="text-danger ms-2">*</span></label>
       <input type="text" name="title" id="title" value="{{$blog->title}}" class="form-control mt-2 @error('title') is-invalid @enderror">
      </div>

       <div class="form-group col-md-12">
          <label for="description">{{ __('admin.Description') }}<span class="text-danger ms-2">*</span></label>
          <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror">{{$blog->description}}</textarea>
      </div>

      <div class="form-group col-md-12">
        <label for="image"> {{ __('admin.Image') }} <span class="text-muted">{{ (__('admin.(Optional)'))}}</span></label>
        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" onchange="previewImage(event)">
        <img src="{{asset('storage/'.$blog->image->path)}}" id="imagePreview" class="mt-3" style="max-width: 300px; height: auto;">
      </div>

      <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary btn-lg">{{__('admin.Update')}}</button>
        <button type="reset" class="btn btn-secondary btn-lg">{{__('admin.Reset')}}</button>
       </div>

</form>
</div>
</div>

@endsection

@section('page-scripts')
  <script src="{{ asset('assets/js/imagePreview.js') }}"></script>
@endsection



