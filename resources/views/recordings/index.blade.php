@extends('layouts.master')

@section('page-title')
    {{ __('admin.All Recordings') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
         <div class="card-body">
                <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Recordings') }} </h1>
                <table class="table table-hover table-bordered" id="data-table">
                    <thead class="table-dark">
                        <tr>
                            <th>{{ __('admin.ID') }}</th>
                            <th>{{ __('admin.Title') }}</th>
                            <th>{{ __('admin.Description') }}</th>
                            <th>{{ __('admin.Courses') }}</th>
                            <th>{{ __('admin.Users') }}</th>
                            <th>{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recordings as $recording)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $recording->title }}</td>
                                <td>{{ \Str::limit($recording->description,10) }}</td>
                                <td>{{ $recording->course->name }}</td>
                                <td>{{ $recording->user->name }}</td>
                                <td>
                                    <a href="{{ route('recordings.show', $recording->id) }}"
                                        class="btn btn-info">{{ __('admin.Show') }}</a>

                                    <a href="{{ route('recordings.edit', $recording->id) }}"
                                        class="btn btn-success">{{ __('admin.Edit') }}</a>
                                    <form action="{{ route('recordings.destroy', $recording->id) }}" method="post"
                                        style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"
                                            style="display: inline-block">{{ __('admin.Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h1 class="text-center">No Recordings Found!</h1>
                        @endforelse
                    </tbody>
                </table>
        </div>
     </div>
   

    @endsection
