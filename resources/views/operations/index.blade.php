@extends('layouts.master')

@section('page-title')
    {{ __('admin.Operations') }}
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
                <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i>
                    {{ __('admin.All Operations') }}</h1>
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
                        @foreach ($operations as $operation)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $operation->name }}</td>
                                <td class="text-center">{{ $operation->email }}</td>
                                <td class="text-center">{{ $operation->phone }}</td>
                                <td class="text-center">{{ $operation->city->name }}</td>
                                <td>
                                    <form action="{{ route('operations.update-status', $operation->id) }}" method="POST" id="status-form-{{ $operation->id }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="{{ $operation->status }}">
                                        <label class="switch">
                                            <input type="checkbox" 
                                                data-id="{{ $operation->id }}" 
                                                class="status-toggle" 
                                                {{ $operation->status === 'active' ? 'checked' : '' }} 
                                                onchange="updateStatus(this, '{{ $operation->id }}');">
                                            <span class="slider round"></span>
                                        </label>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('operations.show', $operation->id) }}"
                                    ><i class="fa-solid fa-eye text-info"></i></a>
                                    <a href="{{ route('operations.edit', $operation->id) }}"
                                    ><i class="fa-solid fa-file-signature text-success"></i></a>
                                    <a href="#" class="btn-delete" data-url="{{ route('operations.destroy',$operation->id) }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form action="{{ route('operations.destroy', $operation->id) }}" method="post" style="display: none;">
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
    <script src="{{ asset('assets/js/operations/operations.js') }}"></script>
@endsection
