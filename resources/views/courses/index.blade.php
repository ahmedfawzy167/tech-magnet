@extends('layouts.master')

@section('page-title')
    {{ __('admin.All Courses') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <h1 class="text-center bg-primary text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Courses') }}
                </h1>
                <table class="table table-hover table-bordered" id="data-table">
                    <thead class="table-dark">
                        <tr>
                            <th>{{ __('admin.Name') }}</th>
                            <th>{{ __('admin.Description') }}</th>
                            <th>{{ __('admin.Price') }}</th>
                            <th>{{ __('admin.Hours') }}</th>
                            <th>{{ __('admin.Category') }}</th>
                            <th>{{ __('admin.Objectives') }}</th>
                            <th>{{ __('admin.Image') }}</th>
                            <th>{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                            <tr>
                                <td>{{ $course->name }}</td>
                                <td>{{\Str::limit($course->description,10) }}</td>
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
                                    <a href="{{ route('courses.show', $course->id) }}"><i class="fa-solid fa-eye text-info"></i></a>
                                    <a href="{{ route('courses.edit', $course->id) }}"><i class="fa-solid fa-file-signature text-success"></i></a>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $course->id }}').submit();">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form id="delete-form-{{ $course->id }}" action="{{ route('courses.destroy', $course->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h1 class="text-center">No Courses Found!</h1>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>

        @include('layouts.messages')


    @endsection
