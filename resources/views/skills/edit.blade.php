@extends('layouts.master')

@section('page-title')
    {{ __('admin.Edit Skill') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center text-light bg-success"><i class="fa-solid fa-pen-to-square"></i> {{trans('admin.Edit Skill')}}</h1></h1>
            <form action="{{ route('skills.update',$skill->id) }}" method="POST" class="row">
                @csrf
                @method('PUT')
                <div class="form-group col-md-12">
                    <label for="title"> {{ __('admin.Title') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="title" id="title" value="{{$skill->title}}"
                        class="form-control @error('title') is-invalid @enderror">
                    
                </div>

                <div class="form-group col-md-12">
                    <label for="content">{{ __('admin.Description') }}<span class="text-danger ms-2">*</span></label>
                    <textarea name="content"
                        class="form-control @error('content') is-invalid @enderror">{{$skill->content}}</textarea>
                </div>
                 
              <div class="form-group col-12">
               <label for="super_skill_id">{{__('admin.Super Skills')}}<span class="text-danger ms-2">*</span></label>
               <select name="super_skill_id" id="super_skill_id" class="form-select">
                @foreach($super_skills as $super_skill)
                  <option value="{{$super_skill->id}}" {{ $super_skill->id == $skill->super_skill_id ? 'selected' : ''}}>{{$super_skill->name}}</option>
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

