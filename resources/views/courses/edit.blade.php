@extends('layouts.master')

@section('page-title')
    {{ __('admin.Edit Course') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body container">
            <h1 class="text-center bg-primary text-white"><i class="ion-plus-circled"></i> {{ __('admin.Edit Course') }}
            </h1>
            <form action="{{ route('courses.update',$course->id) }}" method="POST" enctype="multipart/form-data" class="row">
                @csrf
                @method('PUT')
                <div class="form-group col-md-12">
                    <label for="name"><i class="fa-solid fa-file-signature"></i> {{ __('admin.Name') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="name" id="name" value="{{$course->name}}"
                        class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <strong class="invalid-feedback" role="alert">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="description"><i class="ion-ios-albums"></i> {{ __('admin.Description') }}</label>
                    <textarea type="text" name="description" id="summernote"
                        class="form-control @error('description') is-invalid @enderror">{{ $course->description }}</textarea>
                    @error('description')
                        <strong class="invalid-feedback" role="alert">{{ $message }}</strong>
                    @enderror
                </div>

                 <div class="col-6">
                   <label for="price">{{__('admin.Price')}}<span class="text-danger ms-2">*</span></label>
                  <input type="text" name="price" id="price" value="{{ $course->price }}" class="form-control @error('price') is-invalid @enderror">
                   @error('price')
                    <strong class="invalid-feedback" role="alert">{{ $message }}</strong>
                   @enderror
               </div>

                 <div class="col-6">
                   <label for="hours">{{__('admin.Hours')}}<span class="text-danger ms-2">*</span></label>
                  <input type="text" name="hours" id="hours" value="{{ $course->hours }}" class="form-control @error('hours') is-invalid @enderror">
                   @error('hours')
                    <strong class="invalid-feedback" role="alert">{{ $message }}</strong>
                   @enderror
               </div>

              <div class="form-group col-12">
               <label for="category_id">{{__('admin.Category')}}<span class="text-danger ms-2">*</span></label>
               <select name="category_id" id="category_id" class="form-select">
                @foreach($categories as $category)
                  <option value="{{$category->id}}" {{ $category->id == $course->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                @endforeach
                </select>
              </div>

              <div class="form-group col-12">
                <label for="objective_id">{{__('admin.Objectives')}}<span class="text-danger ms-2">*</span></label>
                <select name="objective_id" id="objective_id" class="form-select">
                 @foreach($objectives as $objective)
                   <option value="{{$objective->id}}" {{ $objective->id == $course->objective_id ? 'selected' : ''}} >{{$objective->name}}</option>
                 @endforeach
                 </select>
               </div>

                <div class="form-group col-md-12">
                    <label for="image"><i class="ion-images"></i> {{ __('admin.Image') }}<span class="text-danger ms-2">*</span></label>
                    <input type="file" name="image" id="images"
                        class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <strong class="invalid-feedback" role="alert">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('admin.Update') }}</button>
                    <button type="reset" class="btn btn-secondary btn-lg">{{ __('admin.Reset') }}</button>
                </div>

            </form>
        </div>
    </div>
@endsection
