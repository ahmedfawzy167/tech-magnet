@extends('layouts.master')

@section('page-title')
   {{__('admin.Show Bundle')}}
@endsection

@section('page-content')

<div class="d-flex justify-content-center align-items-center vh-60">
    <div class="card" style="width: 60rem;">
      <div class="card-body">
        <h2 class="card-title text-center bg-info text-white"><i class="fa-solid fa-eye"></i>   {{__('admin.Bundle Details')}}</h2>
      </div>
      <ul class="list-group list-group-flush">
        <h4 class="list-group-item">{{__('admin.Name')}}: {{$bundle->name}}</h4>
        <h4 class="list-group-item">{{ __('admin.Price')}} ${{$bundle->price}}</h4>
        <h4 class="list-group-item">{{__('admin.Image')}}: 
          @if($bundle?->image && $bundle?->image?->path)
            <img src="{{ getPath('bundles', $bundle->id, $bundle->image->path) }}" width="100px" class="rounded-circle">
          @else
            <span class="badge bg-danger">{{ __('admin.No Image Available') }}</span>
          @endif
          </h4>
        <h6 class="list-group-item">{{__('admin.Courses')}}:
          @foreach ($bundle->courses as $course)
              <li class="ms-4">{{$course?->name ?? 'No Course Name Defined!'}}</li>
          @endforeach
      </h6>
      </ul>
    </div>
  </div>
  <div class="text-center">
     <a href="{{route('bundles.index')}}" class="btn btn-info mt-2">{{__('admin.Back to List')}}</a>
  </div>

@endsection
