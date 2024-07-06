@extends('layouts.master')

@section('page-title')
    {{ __('admin.Edit Roadmap') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body container">
            <h1 class="text-center bg-success text-white"><i class="ion-plus-circled"></i> {{ __('admin.Edit Roadmap') }}
            </h1>
            <form action="{{ route('roadmaps.update',$roadmap->id) }}" method="POST"  class="row">
                @csrf
                @method('PUT')
                <div class="form-group col-md-12">
                    <label for="title"><i class="fa-solid fa-file-signature"></i> {{ __('admin.Name') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="title" id="title" value="{{$roadmap->title}}"
                        class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <strong class="invalid-feedback" role="alert">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="description"><i class="ion-ios-albums"></i> {{ __('admin.Description') }}</label>
                    <textarea type="text" name="description"
                        class="form-control @error('description') is-invalid @enderror">{{$roadmap->description}}</textarea>
                    @error('description')
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
