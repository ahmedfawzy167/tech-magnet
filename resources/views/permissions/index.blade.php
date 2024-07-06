@extends('layouts.master')

@section('page-title')
    {{ __('admin.All Permissions') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Permissions') }}
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
                        @forelse($permissions as $permission)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    
                                    <a href="{{ route('permissions.edit', $permission->id) }}"
                                        class="btn btn-success">{{ __('admin.Edit') }}</a>
                                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="post"
                                        style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"
                                            style="display: inline-block">{{ __('admin.Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h1 class="text-center">No permissions Found!</h1>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

        @include('layouts.messages')


    @endsection
