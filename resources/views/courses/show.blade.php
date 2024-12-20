@extends('layouts.master')

@section('page-title')
   {{__('admin.Show Course')}}
@endsection

@section('page-content')

<div class="d-flex justify-content-center align-items-center vh-60">
    <div class="card" style="width: 60rem;">
      <div class="card-body">
        <h2 class="card-title text-center bg-info text-white"><i class="fa-solid fa-eye"></i>   {{__('admin.Course Details')}}</h2>
      </div>
      <ul class="list-group list-group-flush">
        <h4 class="list-group-item">{{__('admin.Name')}}: {{$course->name}}</h4>
        <h4 class="list-group-item">Original Price: ${{$course->price}}</h4>
        <h4 class="list-group-item">Discounted Price: ${{ $finalPrice }}</h4>
        <h4 class="list-group-item">{{__('admin.Hours')}}: {{$course->hours}}</h4>
        <h4 class="list-group-item">{{__('admin.Category')}}: {{$course?->category?->name}}</h4>
        <h4 class="list-group-item">{{__('admin.Image')}}: <img src="{{asset('storage/'.$course->image->path)}}" width="100px" class="rounded-circle ms-3"></h4>
        <h6 class="list-group-item">{{__('admin.Roadmaps')}}:
          @foreach ($course->roadmaps as $roadmap)
              <li class="ms-4">{{$roadmap?->title ?? 'No Roadmap Defined!'}}</li>
          @endforeach
      </h6>
      </ul>
    </div>
  </div>
  <div class="text-center">
     <a href="{{route('courses.index')}}" class="btn btn-info mt-2">{{__('admin.Back to List')}}</a>
  </div>

@endsection
