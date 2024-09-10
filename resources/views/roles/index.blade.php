@extends('layouts.master')

@section('page-title')
    {{ __('admin.All Roles') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
         <div class="card-body">
                <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Roles') }}
                </h1>
                <table class="table table-hover table-bordered" id="data-table">
                    <thead class="table-dark">
                        <tr>
                            <th>{{ __('admin.ID') }}</th>
                            <th>{{ __('admin.Name') }}</th>
                            <th>{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a href="{{ route('roles.show', $role->id) }}"><i class="fa-solid fa-eye text-info"></i></a>
                                    <a href="{{ route('roles.edit', $role->id) }}"><i class="fa-solid fa-file-signature text-success"></i></a>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $role->id }}').submit();">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h1 class="text-center">{{ __('admin.No Roles Found!') }}</h1>
                        @endforelse
                    </tbody>
                </table>
        </div>
        </div>


    @endsection
