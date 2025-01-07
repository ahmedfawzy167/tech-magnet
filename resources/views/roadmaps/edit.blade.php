@extends('layouts.master')

@section('page-title')
    {{ __('admin.Edit Roadmap') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center text-light bg-success"><i class="fa-solid fa-pen-to-square"></i> {{trans('admin.Edit Roadmap')}}</h1>
            <form action="{{ route('roadmaps.update',$roadmap->id) }}" method="POST"  class="row">
                @csrf
                @method('PUT')
                <div class="form-group col-md-12">
                    <label for="title">{{ __('admin.Name') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="title" id="title" value="{{$roadmap->title}}"
                        class="form-control @error('title') is-invalid @enderror">
                </div>

                <div class="form-group col-md-12">
                    <label for="description">{{ __('admin.Description') }}<span class="text-danger ms-2">*</span></label>
                    <textarea name="description"
                        class="form-control @error('description') is-invalid @enderror">{{$roadmap->description}}</textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('admin.Update') }}</button>
                    <button type="reset" class="btn btn-secondary btn-lg">{{ __('admin.Reset') }}</button>
                </div>

            </form>
        </div>
    </div>
    @endsection
