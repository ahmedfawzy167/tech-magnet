@extends('layouts.master')

@section('page-title')
    {{ __('admin.All Categories') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Categories') }}
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
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('categories.show', $category->id) }}"
                                        class="btn btn-info">{{ __('admin.Show') }}</a>
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                        class="btn btn-success">{{ __('admin.Edit') }}</a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="post"
                                        style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"
                                            style="display: inline-block">{{ __('admin.Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h1 class="text-center">No Categories Found!</h1>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

        @include('layouts.messages')


    @endsection
