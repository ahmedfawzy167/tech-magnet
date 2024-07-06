@extends('layouts.master')

@section('page-title')
    {{ __('admin.Edit Super Skill') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body container">
            <h1 class="text-center bg-success text-white"><i class="ion-plus-circled"></i> {{ __('admin.Edit Super Skill') }}
            </h1>
            <form action="{{ route('super-skills.update', $superSkill->id) }}" method="POST" class="row">
                @csrf
                @method('PUT')
                <div class="form-group col-md-12">
                    <label for="name">{{ __('admin.Name') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="name" id="name" value="{{$superSkill->name}}"
                        class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <strong class="invalid-feedback" role="alert">{{ $message }}</strong>
                    @enderror
                </div>

              <div class="form-group col-12">
               <label for="course_id">{{__('admin.Course')}}<span class="text-danger ms-2">*</span></label>
               <select name="course_id" id="course_id" class="form-select">
                @foreach($courses as $course)
                  <option value="{{$course->id}}">{{$course->name}}</option>
                @endforeach
                </select>
              </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('admin.Update') }}</button>
                    <button type="reset" class="btn btn-secondary btn-lg">{{ __('admin.Reset') }}</button>
                </div>

            </form>
        </div>
    </div>
@endsection
