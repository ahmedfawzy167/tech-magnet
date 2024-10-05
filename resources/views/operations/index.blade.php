@extends('layouts.master')

@section('page-title')
    {{ __('admin.Operations') }}
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
                            <th>{{ __('admin.ID') }}</th>
                            <th>{{ __('admin.Name') }}</th>
                            <th>{{ __('admin.Email') }}</th>
                            <th>{{ __('admin.Phone') }}</th>
                            <th>{{ __('admin.City') }}</th>
                            <th>{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($operations as $operation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $operation->name }}</td>
                                <td>{{ $operation->email }}</td>
                                <td>{{ $operation->phone }}</td>
                                <td>{{ $operation->city->name }}</td>
                                <td>
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
