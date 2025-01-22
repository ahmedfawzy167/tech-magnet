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
        <h6 class="list-group-item">{{__('admin.Name')}}: {{$course->name}}</h6>
        <h6 class="list-group-item">{{ __('admin.Original Price') }}: ${{$course->price}}</h6>
        <h6 class="list-group-item">{{ __('admin.Discounted Price') }}: ${{ $finalPrice }}</h6>
        <h6 class="list-group-item">{{__('admin.Hours')}}: {{$course->hours}}</h6>
        <h6 class="list-group-item">{{__('admin.Category')}}: {{$course?->category?->name}}</h6>
        <h6 class="list-group-item">{{__('admin.Image')}}: 
          @if($course?->image && $course?->image?->path)
            <img src="{{ getPath('courses', $course->id, $course->image->path) }}" width="100px" class="rounded-circle">
          @else
            <span class="badge bg-danger">{{ __('admin.No Image Available') }}</span>
          @endif
        </h6>
        <h6 class="list-group-item">{{__('admin.Roadmaps')}}:
          @foreach ($course->roadmaps as $roadmap)
            <li class="ms-4">{{ $roadmap?->title ?? __('admin.No Roadmap Defined!') }}</li>
          @endforeach
      </h6>

      <h6 class="list-group-item">{{ __('admin.Schedules') }}:
        @if($course->schedules->isNotEmpty())
            <div class="ms-4">
                @foreach ($course->schedules as $schedule)
                    <div class="schedule-item mt-2 border rounded shadow-sm">
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">{{ __('admin.Start Date') }}:</span>
                            <span>{{ \Carbon\Carbon::parse($schedule->start_date)->format('d-m-Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">{{ __('admin.End Date') }}:</span>
                            <span>{{ \Carbon\Carbon::parse($schedule->end_date)->format('d-m-Y') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <span class="badge bg-warning">{{ __('admin.No Schedules Available') }}</span>
        @endif
    </h6>
    
      </ul>
    </div>
  </div>
  <div class="text-center">
     <a href="{{route('courses.index')}}" class="btn btn-info mt-2">{{__('admin.Back to List')}}</a>
  </div>

@endsection
