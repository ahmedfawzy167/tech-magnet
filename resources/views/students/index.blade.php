@extends('layouts.master')

@section('page-title')
    {{ __('admin.Students') }}
@endsection

@section('page-head')

<link rel="stylesheet" href="{{ asset('assets/css/users/users.css') }}">

@endsection


@section('page-content')
    <div class="row">
        <div class="card">
         <div class="card-body">
                <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Students') }}</h1>
                <table class="table table-hover table-bordered" id="data-table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">{{ __('admin.ID') }}</th>
                            <th class="text-center">{{ __('admin.Name') }}</th>
                            <th class="text-center">{{ __('admin.Email') }}</th>
                            <th class="text-center">{{ __('admin.Phone') }}</th>
                            <th class="text-center">{{__('admin.Status')}}</th>
                            <th class="text-center">{{ __('admin.Block/Unblock') }}</th>
                            <th class="text-center">{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $student->name }}</td>
                                <td class="text-center">{{ $student->email }}</td>
                                <td class="text-center">{{ $student->phone }}</td>
                                <td class="text-center">
                                    <form action="{{ route('students.update-status', $student->id) }}" method="POST" id="status-form-{{ $student->id }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="{{ $student->status }}">
                                        <label class="switch">
                                            <input type="checkbox" 
                                                data-id="{{ $student->id }}" 
                                                class="status-toggle" 
                                                {{ $student->status === 'active' ? 'checked' : '' }} 
                                                onchange="updateStatus(this, '{{ $student->id }}');">
                                            <span class="slider round"></span>
                                        </label>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('students.block', $student->id) }}" method="POST" id="block-form-{{ $student->id }}">
                                        @csrf
                                        @method('PUT')
                                        <label class="switch">
                                            <input type="checkbox" 
                                                class="block-toggle" 
                                                {{ $student->is_blocked ? 'checked' : '' }} 
                                                onchange="toggleBlock(this, '{{ $student->id }}');">
                                            <span class="slider round"></span>
                                        </label>
                                        <input type="number" name="duration" min="1" placeholder="Duration" class="duration-input" style="width: 100px; display: {{ $student->is_blocked ? 'inline' : 'none' }};">
                                        <select name="unit" class="unit-select" style="display: {{ $student->is_blocked ? 'inline' : 'none' }};">
                                            <option value="minutes">Minutes</option>
                                            <option value="days">Days</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('students.show', $student->id) }}"
                                    ><i class="fa-solid fa-eye text-info"></i></a>
                                    <a href="{{ route('students.edit', $student->id) }}"
                                    ><i class="fa-solid fa-file-signature text-success"></i></a>
                                    <a href="#" class="btn-delete" data-url="{{ route('students.destroy',$student->id) }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form action="{{ route('students.destroy', $student->id) }}" method="post" style="display: none;">
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
<script src="{{ asset('assets/js/students/students.js') }}"></script>

<script>
    function toggleBlock(element, studentId) {
        const blockForm = document.getElementById(`block-form-${studentId}`);
        const isBlocked = element.checked;
        const durationInput = blockForm.querySelector('.duration-input');
    
        // Construct the URL directly
        const blockUrl = isBlocked ? 
            `/admin/students/${studentId}/block` : 
            `/admin/students/${studentId}/unblock`;
        
        blockForm.setAttribute('action', blockUrl);
    
        if (isBlocked) {
            const duration = durationInput.value;
            const durationField = document.createElement('input');
            durationField.type = 'hidden';
            durationField.name = 'duration';
            durationField.value = duration;
            blockForm.appendChild(durationField);
        } else {
            const durationField = blockForm.querySelector('input[name="duration"]');
            if (durationField) {
                blockForm.removeChild(durationField);
            }
        }
    
        blockForm.submit();
    }
    </script>

@endsection
