@extends('layouts.master')

@section('page-title')
    {{ __('admin.Trashed Courses') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
        <div class="card-body">
             <h1 class="text-center bg-warning text-light"><i class="ion-alert"></i> {{ __('admin.All Trashed Courses')}} </h1>
              <!-- Bulk Delete Form -->
              <form action="{{ route('courses.bulk-destroy') }}" method="post" style="margin-bottom: 20px;">
                @csrf
                @method('delete')
                 <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete the selected courses?');">
                   {{ __('admin.Delete Selected') }}
                 </button>
                 <table class="table table-hover table-bordered mt-3"  id="data-table">
                  <thead class="table-dark">
                    <tr>
                        <th><input type="checkbox" id="check-all"></th>
                            <th class="text-center">{{ __('admin.ID') }}</th>
                            <th class="text-center">{{ __('admin.Name') }}</th>
                            <th class="text-center">{{ __('admin.Price') }}</th>
                            <th class="text-center">{{ __('admin.Hours') }}</th>
                            <th class="text-center">{{ __('admin.Category') }}</th>
                            <th class="text-center">{{ __('admin.Image') }}</th>
                            <th class="text-center">{{ __('admin.Date') }}</th>
                            <th class="text-center">{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trashedCourses as $course)
                            <tr>
                                <td class="text-center"><input type="checkbox" name="ids[]" value="{{ $course->id }}"></td>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $course->name }}</td>
                                <td class="text-center">{{ $course->price }}</td>
                                <td class="text-center">{{ $course->hours }}</td>
                                <td class="text-center">{{ $course?->category?->name ?? 'UnCategorized' }}</td>
                                <td class="text-center">
                                    @if($course->image)
                                        <img src="{{ asset('storage/' . $course->image->path) }}" width="70px" class="mr-2">
                                    @endif
                                </td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($course->created_at)->diffForHumans() }}</td>
                                <td class="text-center">
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
                       
                        @endforeach
                    </tbody>
                 </table>
              </form>
        </div>
    </div>

    @endsection
