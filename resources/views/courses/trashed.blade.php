@extends('layouts.master')

@section('page-title')
    All Trashed Courses
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
        <div class="card-body">
             <h1 class="text-center bg-warning text-light"><i class="ion-alert"></i> All Trashed Courses</h1>
             <table class="table table-hover table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                            <th>{{ __('admin.Name') }}</th>
                            <th>{{ __('admin.Price') }}</th>
                            <th>{{ __('admin.Hours') }}</th>
                            <th>{{ __('admin.Category') }}</th>
                            <th>{{ __('admin.Objectives') }}</th>
                            <th>{{ __('admin.Image') }}</th>
                            <th>{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($trashedCourses as $course)
                            <tr>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->price }}</td>
                                <td>{{ $course->hours }}</td>
                                <td>{{ $course->category->name }}</td>
                                @if(isset($course->objective))
                                 <td>{{ $course->objective->name }}</td>
                                @endif
                                <td>
                                    @if($course->image)
                                        <img src="{{ asset('storage/' . $course->image->path) }}" width="70px" class="mr-2">
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('courses.restore', $course->id) }}" method="post" style="display: inline-block;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success"><i class="ion-loop"></i> Restore</button>
                                    </form>
                                
                                    <form action="{{ route('courses.force-delete', $course->id) }}" method="post" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="ion-trash-a"></i> Force Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <div>
                             <td colspan="8">
                               <h1 class="text-center alert alert-warning">No Trashed Courses Found!</h1>
                            </td>
                           </div>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
        </div>
    </div>

        @include('layouts.messages')


    @endsection
