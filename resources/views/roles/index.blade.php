@extends('layouts.master')

@section('page-title')
    {{ __('admin.All Roles') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
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
                                    <a href="{{ route('roles.show', $role->id) }}"
                                        class="btn btn-info">{{ __('admin.Show') }}</a>
                                    <a href="{{ route('roles.edit', $role->id) }}"
                                        class="btn btn-success">{{ __('admin.Edit') }}</a>
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="post"
                                        style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"
                                            style="display: inline-block">{{ __('admin.Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h1 class="text-center">No roles Found!</h1>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

        @include('layouts.messages')


    @endsection
