@extends('layouts.master')

@section('page-title')
  {{ __('admin.Enrollments') }}
@endsection

@section('page-head')
<style>
    .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 20px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #66bb6a;
}

input:checked + .slider:before {
    transform: translateX(26px);
}

</style>
    
@endsection


@section('page-content')
    <div class="row">
        <div class="card">
          <div class="card-body">
                <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.Enrollments') }}</h1>
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">{{__('admin.ID')}}</th>
                            <th class="text-center">{{__('admin.User')}}</th>
                            <th class="text-center">{{__('admin.Course')}}</th>
                            <th class="text-center">{{__('admin.Date')}}</th>
                            <th class="text-center">{{__('admin.Status')}}</th>
                            <th class="text-center">{{__('admin.Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enrollments as $enrollment)
                        <tr>
                            <td class="text-center">{{$loop->index+1}}</td>
                            <td class="text-center">{{$enrollment?->user?->name}}</td>
                            <td class="text-center">{{$enrollment?->course?->name}}</td>
                            <td class="text-center">{{\Carbon\Carbon::parse($enrollment->date)->diffForHumans()}}</td>
                            <td class="text-center">
                                <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST" id="status-form-{{ $enrollment->id }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="{{ $enrollment->status }}"> <!-- Add this hidden field -->
                                    <label class="switch">
                                        <input type="checkbox" 
                                            data-id="{{ $enrollment->id }}" 
                                            class="status-toggle" 
                                            {{ $enrollment->status === 'approved' ? 'checked' : '' }} 
                                            onchange="updateStatus(this, '{{ $enrollment->id }}');">
                                        <span class="slider round"></span>
                                    </label>
                                </form>
                            </td>
                            <td class="text-center">
                                <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $enrollment->id }}').submit();">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </a>
                                <form id="delete-form-{{ $enrollment->id }}" action="{{ route('enrollments.destroy', $enrollment->id) }}" method="post" style="display: none;">
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
    </div>


@endsection

@section('page-scripts')
<script>
    function updateStatus(element, enrollmentId) {
    const form = document.getElementById(`status-form-${enrollmentId}`);
    const checkbox = element.checked;
    const status = checkbox ? 'approved' : 'pending';

    form.querySelector('input[name="status"]').value = status;

    form.submit();
}

</script>
    
@endsection