@extends('layouts.master')

@section('page-title')
    {{ __('admin.Trashed Courses') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
        <div class="card-body">
             <h1 class="text-center bg-warning text-light"><i class="ion-alert"></i> {{ __('admin.All Trashed Courses')}} </h1>
             <table class="table table-hover table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                            <th>{{ __('admin.ID') }}</th>
                            <th>{{ __('admin.Name') }}</th>
                            <th>{{ __('admin.Price') }}</th>
                            <th>{{ __('admin.Hours') }}</th>
                            <th>{{ __('admin.Category') }}</th>
                            <th>{{ __('admin.Image') }}</th>
                            <th>{{ __('admin.Date') }}</th>
                            <th>{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($trashedCourses as $course)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->price }}</td>
                                <td>{{ $course->hours }}</td>
                                <td>{{ $course?->category?->name ?? 'UnCategorized' }}</td>
                                <td>
                                    @if($course->image)
                                        <img src="{{ asset('storage/' . $course->image->path) }}" width="70px" class="mr-2">
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($course->created_at)->diffForHumans() }}</td>
                                <td>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('restore-form-{{ $course->id }}').submit();">
                                        <i class="fa-solid fa-arrow-rotate-left text-success"></i>                                    
                                    </a>
                                    <form id="restore-form-{{ $course->id }}" action="{{ route('courses.restore', $course->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                    </form>

                                    <a href="#" class="btn-delete-forever" data-url="{{ route('courses.force-delete', $course->id) }}">
                                        <i class="fa-solid fa-trash-can text-danger ms-2"></i>
                                    </a>
                                    <form id="delete-form-{{ $course->id }}" action="{{ route('courses.force-delete', $course->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <div>
                             <td colspan="8">
                               <h1 class="text-center alert alert-warning">{{__('admin.No Trashed Courses Found!')}}</h1>
                            </td>
                           </div>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
        </div>
    </div>

    @endsection
