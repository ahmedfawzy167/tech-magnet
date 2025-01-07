@extends('layouts.master')

@section('page-title')
    {{ __('admin.Mentors') }}
@endsection

@section('page-head')
  <link rel="stylesheet" href="{{ asset('assets/css/users/users.css') }}">
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
         <div class="card-body">
                <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i>
                    {{ __('admin.All Mentors') }}</h1>
                <table class="table table-hover table-bordered" id="data-table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">{{ __('admin.ID') }}</th>
                            <th class="text-center">{{ __('admin.Name') }}</th>
                            <th class="text-center">{{ __('admin.Email') }}</th>
                            <th class="text-center">{{ __('admin.Phone') }}</th>
                            <th class="text-center">{{ __('admin.City') }}</th>
                            <th class="text-center">{{__('admin.Status')}}</th>
                            <th class="text-center">{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mentors as $mentor)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $mentor->name }}</td>
                                <td class="text-center">{{ $mentor->email }}</td>
                                <td class="text-center">{{ $mentor->phone }}</td>
                                <td class="text-center">{{ $mentor?->city?->name ?? __('admin.No City Found')}}</td>
                                <td>
                                    <form action="{{ route('mentors.update-status', $mentor->id) }}" method="POST" id="status-form-{{ $mentor->id }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="{{ $mentor->status }}">
                                        <label class="switch">
                                            <input type="checkbox" 
                                                data-id="{{ $mentor->id }}" 
                                                class="status-toggle" 
                                                {{ $mentor->status === 'active' ? 'checked' : '' }} 
                                                onchange="updateStatus(this, '{{ $mentor->id }}');">
                                            <span class="slider round"></span>
                                        </label>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('mentors.show', $mentor->id) }}"
                                    ><i class="fa-solid fa-eye text-info"></i></a>
                                    <a href="{{ route('mentors.edit', $mentor->id) }}"
                                    ><i class="fa-solid fa-file-signature text-success"></i></a>
                                    <a href="#" class="btn-delete" data-url="{{ route('mentors.destroy',$mentor->id) }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form action="{{ route('mentors.destroy', $mentor->id) }}" method="post" style="display: none;">
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
<script src="{{ asset('assets/js/mentors/mentors.js') }}"></script>
@endsection