@extends('layouts.master')

@section('page-title')
    {{ __('admin.New Roadmap') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center bg-primary text-white"><i class="ion-plus-circled"></i> {{ __('admin.Add New Roadmap') }}</h1>
            <form action="{{ route('roadmaps.store') }}" method="POST" enctype="multipart/form-data" class="row">
                @csrf
                <div class="form-group col-md-12">
                    <label for="title"> {{ __('admin.Title') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="title" id="title"
                        class="form-control @error('title') is-invalid @enderror">
                </div>

                <div class="form-group col-md-12">
                    <label for="description"> {{ __('admin.Description') }}<span class="text-danger ms-2">*</span></label>
                    <textarea name="description" id="cKEditor"  class="form-control @error('description') is-invalid @enderror"></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('admin.Add') }}</button>
                    <button type="reset" class="btn btn-secondary btn-lg">{{ __('admin.Reset') }}</button>
                </div>

            </form>
        </div>
    </div>
    @endsection


    

 
