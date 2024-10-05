@extends('layouts.master')

@section('page-title')
    {{ __('admin.Instructors') }}
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
                            <th>{{ __('admin.ID') }}</th>
                            <th>{{ __('admin.Name') }}</th>
                            <th>{{ __('admin.Email') }}</th>
                            <th>{{ __('admin.Phone') }}</th>
                            <th>{{ __('admin.City') }}</th>
                            <th>{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($instructors as $instructor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $instructor->name }}</td>
                                <td>{{ $instructor->email }}</td>
                                <td>{{ $instructor->phone }}</td>
                                <td>{{ $instructor->city->name }}</td>
                                <td>
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
