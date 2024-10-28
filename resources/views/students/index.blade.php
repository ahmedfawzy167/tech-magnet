@extends('layouts.master')

@section('page-title')
    {{ __('admin.Students') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
         <div class="card-body">
                <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i>
                    {{ __('admin.All Students') }}</h1>
                <table class="table table-hover table-bordered" id="data-table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">{{ __('admin.ID') }}</th>
                            <th class="text-center">{{ __('admin.Name') }}</th>
                            <th class="text-center">{{ __('admin.Email') }}</th>
                            <th class="text-center">{{ __('admin.Phone') }}</th>
                            <th class="text-center">{{ __('admin.City') }}</th>
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
                                <td class="text-center">{{ $student->city->name }}</td>
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
