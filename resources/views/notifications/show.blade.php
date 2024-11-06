@extends('layouts.master')

@section('page-title')
  {{__('admin.Show Notification')}}
@endsection

@section('page-content')

<div class="d-flex justify-content-center align-items-center vh-60 mt-3">
    <div class="card" style="width: 60rem;">
      <div class="card-body">
        <h2 class="card-title text-center bg-success text-white">{{ $notification->data['message'] }}</h2>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">{{ __('Course ID') }}: {{ $notification->data['course_id'] }}</li>
        <li class="list-group-item">{{ __('Course Name') }}: {{ $notification->data['course_name'] }}</li>
        <li class="list-group-item">{{ __('Notification Date') }}:  <span class="badge badge-primary">{{ $notification->created_at->format('F j, Y') }}</span></li>
      </ul>
    </div>
  </div>
  
@endsection
