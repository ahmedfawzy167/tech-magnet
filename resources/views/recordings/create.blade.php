@extends('layouts.master')

@section('page-title')
    {{ __('admin.New Recording') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center bg-primary text-white"><i class="ion-plus-circled"></i> {{ __('admin.Add New Recording') }}</h1>
            <form action="{{ route('recordings.store') }}" method="POST" class="row" enctype="multipart/form-data">
                @csrf
                <div class="form-group col-12">
                    <label for="title"> {{ __('admin.Title') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="title" id="title"
                        class="form-control @error('title') is-invalid @enderror">                    
                </div>

                <div class="form-group col-12">
                    <label for="description">{{ __('admin.Description') }}<span class="text-danger ms-2">*</span></label>
                    <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror"></textarea>
                    </textarea> 
                </div>

                <div class="form-group">
                  <label for="video_src">Choose Video</label>
                  <input type="file" class="form-control" id="video_src" name="video_src" accept="video/*" required>
                  <small class="form-text text-muted">Accepted formats: MP4, M4V, and other video files.</small>
                </div>


                <div class="form-group col-12">
                    <label for="course_id">{{__('admin.Courses')}}<span class="text-danger ms-2">*</span></label>
                    <select name="course_id" id="course_id" class="form-select @error('course_id') is-invalid @enderror">
                     <option value="#" selected>Choose One..</option>
                     @foreach($courses as $course)
                       <option value="{{$course->id}}">{{$course->name}}</option>
                     @endforeach
                     </select>
                   </div>


                   <div class="form-group col-12">
                    <label for="user_id">{{__('admin.Users')}}<span class="text-danger ms-2">*</span></label>
                    <select name="user_id" id="user_id" class="form-select @error('user_id"') is-invalid @enderror">
                     <option value="#" selected>Choose One..</option>
                     @foreach($users as $user)
                       <option value="{{$user->id}}">{{$user->name}}</option>
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
    
   
