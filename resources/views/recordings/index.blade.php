@extends('layouts.master')

@section('page-title')
    {{ __('admin.Recordings') }}
@endsection

@section('page-content')
<div class="row">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Recordings') }}</h1>
            
            <div class="row">
                @if(count($recordings) > 0)
                    @foreach($recordings as $recording)

                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <video width="100%" controls>
                                        <source src="{{ asset('storage/' . $recording) }}" type="video/mp4">
                                    </video>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center bg-warning">{{ __('admin.No Recordings Found') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection