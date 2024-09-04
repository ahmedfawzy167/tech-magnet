@extends('layouts.master')

@section('page-title')
    {{ __('admin.New Skill') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center bg-primary text-white"><i class="ion-plus-circled"></i> {{ __('admin.Add New Skill') }}</h1>
            <form action="{{ route('skills.store') }}" method="POST" class="row">
                @csrf
                <div class="form-group col-12">
                    <label for="title"> {{ __('admin.Title') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="title" id="title"
                        class="form-control @error('title') is-invalid @enderror">
                    
                </div>

                <div class="form-group col-12">
                    <label for="content">{{ __('admin.Content') }}<span class="text-danger ms-2">*</span></label>
                    <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror"></textarea>
                    </textarea> 
                </div>
                 
              <div class="form-group col-12">
               <label for="super_skill_id">{{__('admin.Super Skills')}}<span class="text-danger ms-2">*</span></label>
               <select name="super_skill_id" id="super_skill_id" class="form-select @error('super_skill_id') is-invalid @enderror">
                <option value="#" selected>Choose One..</option>
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
    
  
