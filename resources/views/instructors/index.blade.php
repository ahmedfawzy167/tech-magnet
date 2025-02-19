@extends('layouts.master')

@section('page-title')
    {{ __('admin.Instructors') }}
@endsection

@section('page-head')

<link rel="stylesheet" href="{{ asset('assets/css/users/users.css') }}">

@endsection

@section('page-content')
    <div class="row">
        <div class="card">
         <div class="card-body">
                <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i>
                    {{ __('admin.All Instructors') }}</h1>
                <table class="table table-hover table-bordered" id="data-table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">{{ __('admin.ID') }}</th>
                            <th class="text-center">{{ __('admin.Name') }}</th>
                            <th class="text-center">{{ __('admin.Email') }}</th>
                            <th class="text-center">{{ __('admin.Phone') }}</th>
                            <th class="text-center">{{__('admin.Status')}}</th>
                            <th class="text-center">{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($instructors as $instructor)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $instructor->name }}</td>
                                <td class="text-center">{{ $instructor->email }}</td>
                                <td class="text-center">{{ $instructor->phone }}</td>
                                <td class="text-center">
                                    <form action="{{ route('instructors.update-status', $instructor->id) }}" method="POST" id="status-form-{{ $instructor->id }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="{{ $instructor->status }}">
                                        <label class="switch">
                                            <input type="checkbox" 
                                                data-id="{{ $instructor->id }}" 
                                                class="status-toggle" 
                                                {{ $instructor->status === 'active' ? 'checked' : '' }} 
                                                onchange="updateStatus(this, '{{ $instructor->id }}');">
                                            <span class="slider round"></span>
                                        </label>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('instructors.show', $instructor->id) }}"
                                    ><i class="fa-solid fa-eye text-info"></i></a>
                                    <a href="{{ route('instructors.edit', $instructor->id) }}"
                                    ><i class="fa-solid fa-file-signature text-success"></i></a>
                                    <a href="#" class="btn-delete" data-url="{{ route('instructors.destroy',$instructor->id) }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form action="{{ route('instructors.destroy', $instructor->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
        </div>

@endsection

@section('page-scripts')
<script src="{{ asset('assets/js/insctructors/instructors.js') }}"></script>
@endsection