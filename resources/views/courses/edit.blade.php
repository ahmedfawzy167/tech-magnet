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

              <div class="form-group col-6 mt-3">
               <label for="category_id">{{__('admin.Category')}}<span class="text-danger ms-2">*</span></label>
               <select name="category_id" id="category_id" class="form-select">
                @foreach($categories as $category)
                  <option value="{{$category->id}}" {{ $category->id == $course->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                @endforeach
                </select>
              </div>

              <div class="form-group col-6 mt-3">
                <label for="objective_id">{{__('admin.Objective')}}<span class="text-danger ms-2">*</span></label>
                <select name="objective_id" id="objective_id" class="form-select">
                 @foreach($objectives as $objective)
                   <option value="{{$objective->id}}" {{ $objective->id == $course->objective_id ? 'selected' : ''}} >{{$objective->name}}</option>
                 @endforeach
                 </select>
               </div>

               <div class="form-group col-6 mt-3">
                <label for="roadmaps">{{__('admin.Roadmaps')}}<span class="text-danger ms-2">*</span></label>
                <select name="roadmaps[]" id="roadmaps" multiple class="form-select @error('roadmap_id') is-invalid @enderror">
                    @foreach($roadmaps as $roadmap)
                      <option value="{{$roadmap->id}}" {{ $course->roadmaps->contains($roadmap->id) ? 'selected' : '' }}>{{$roadmap->title}}</option>
                    @endforeach
                 </select>
               </div>

                <div class="form-group col-md-12">
                    <label for="image"> {{ __('admin.Image') }}</label>
                    <input type="file" name="image" id="images"
                        class="form-control @error('image') is-invalid @enderror">
                        <img src="{{asset('storage/'.$course->image->path)}}" class="rounded-circle mt-2" width="200px">

                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('admin.Update') }}</button>
                    <button type="reset" class="btn btn-secondary btn-lg">{{ __('admin.Reset') }}</button>
                </div>

            </form>
        </div>
    </div>
    @endsection
