@extends('layouts.master')

@section('page-title')
    {{ __('admin.Edit Recording') }}
@endsection

@section('page-content')
<div class="card">
    <div class="card-body">
        <h1 class="text-center text-light bg-success"><i class="fa-solid fa-pen-to-square"></i> {{trans('admin.Edit Recording')}}</h1>
        <form action="{{ route('recordings.update',$recording->id) }}" method="POST" class="row" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group col-12">
                <label for="title"> {{ __('admin.Title') }}<span class="text-danger ms-2">*</span></label>
                <input type="text" name="title" id="title" value="{{ $recording->title }}"
                    class="form-control @error('title') is-invalid @enderror">                    
            </div>

            <div class="form-group col-12">
                <label for="description">{{ __('admin.Description') }}<span class="text-danger ms-2">*</span></label>
                <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror">{{ $recording->description }}</textarea>
                </textarea> 
            </div>

            <div class="form-group">
              <label for="video_src">Choose Video</label>
              <input type="file" class="form-control" id="video_src" name="video_src" accept="video/*" required>
              <video width="400" height="400" autoplay controls>
                <source src="{{ asset('storage/recordings/'.$recording->video_src)}}">
            </div>

            <div class="form-group col-12">
                <label for="course_id">{{__('admin.Courses')}}<span class="text-danger ms-2">*</span></label>
                <select name="course_id" id="course_id" class="form-select @error('course_id') is-invalid @enderror">
                 <option value="#" selected>Choose One..</option>
                 @foreach($courses as $course)
                   <option value="{{$course->id}}" {{ $course->id == $recording->course_id ? 'selected' : ''}}>{{$course->name}}</option>
                 @endforeach
                 </select>
               </div>


               <div class="form-group col-12">
                <label for="user_id">{{__('admin.Users')}}<span class="text-danger ms-2">*</span></label>
                <select name="user_id" id="user_id" class="form-select @error('user_id"') is-invalid @enderror">
                 <option value="#" selected>Choose One..</option>
                 @foreach($users as $user)
                   <option value="{{$user->id}}" {{ $user->id == $recording->user_id ? 'selected' : ''}}>{{$user->name}}</option>
                 @endforeach
                 </select>
               </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">{{ __('admin.Save Changes') }}</button>
                <button type="reset" class="btn btn-secondary btn-lg">{{ __('admin.Reset') }}</button>
            </div>

        </form>
    </div>
</div>

@endsection