@extends('layouts.master')

@section('page-title')
   {{__('admin.Show Recording')}}
@endsection

@section('page-content')

<div class="d-flex justify-content-center align-items-center vh-60 mt-3">
    <div class="card" style="width: 60rem;">
      <div class="card-body">
        <h2 class="card-title text-center bg-info text-white"><i class="fa-solid fa-eye"></i> {{__('admin.Show Blog')}}</h2>
      </div>
      <ul class="list-group list-group-flush">
        <h6 class="list-group-item">{{__('admin.Title')}}: {{$recording->title}}</h6>
        <h6 class="list-group-item">{{__('admin.Description')}}: {{$recording->description}}</h6>
        <h6 class="list-group-item">{{__('admin.Course')}}: {{$recording->course->name}}</h6>
        <h6 class="list-group-item">{{__('admin.User')}}: {{$recording->user->name}}</h6>
        <h6 class="list-group-item"><video controls width="600" height="400" autoplay>
            <source src="{{ asset('storage/recordings/'.$recording->video_src) }}">
            </video>
        </h6>
      </ul>
    </div>
  </div>
  <div class="text-center mt-2">
    <a href="{{route('recordings.index')}}" class="btn btn-info text-white">{{__('admin.Back to List')}}</a>
 </div>


@endsection
