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
                                
                <div class="form-group">
                  <label for="video_src">{{ __('admin.Choose Video') }}</label>
                  <input type="file" class="form-control" id="video_src" name="video_src" accept="video/*" required>
                  <small class="form-text text-muted">{{ __('admin.Accepted formats: MP4, M4V, and other video files') }}</small>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('admin.Add') }}</button>
                    <button type="reset" class="btn btn-secondary btn-lg">{{ __('admin.Reset') }}</button>
                </div>

            </form>
        </div>
    </div>
    @endsection
    
   
