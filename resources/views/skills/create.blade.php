@extends('layouts.master')

@section('page-title')
    {{ __('admin.Add New Skill') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body container">
            <h1 class="text-center bg-primary text-white"><i class="ion-plus-circled"></i> {{ __('admin.Add New Skill') }}
            </h1>
            <form action="{{ route('skills.store') }}" method="POST" enctype="multipart/form-data" class="row">
                @csrf
                <div class="form-group col-md-12">
                    <label for="title"> {{ __('admin.Name') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="title" id="title"
                        class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <strong class="invalid-feedback" role="alert">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="content"><i class="ion-ios-albums"></i> {{ __('admin.Content') }}</label>
                    <textarea type="text" name="content"
                        class="form-control @error('content') is-invalid @enderror"></textarea>
                    @error('content')
                        <strong class="invalid-feedback" role="alert">{{ $message }}</strong>
                    @enderror
                </div>
                 
              <div class="form-group col-12">
               <label for="super_skill_id">{{__('admin.Super Skills')}}<span class="text-danger ms-2">*</span></label>
               <select name="super_skill_id" id="super_skill_id" class="form-select">
                @foreach($super_skills as $super_skill)
                  <option value="{{$super_skill->id}}">{{$super_skill->name}}</option>
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
