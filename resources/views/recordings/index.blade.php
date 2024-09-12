@extends('layouts.master')

@section('page-title')
    {{ __('admin.Recordings') }}
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
                                    <a href="{{ route('recordings.show', $recording->id) }}"><i class="fa-solid fa-eye text-info"></i></a>
                                    <a href="{{ route('recordings.edit', $recording->id) }}"><i class="fa-solid fa-file-signature text-success"></i></a>
                                    <a href="#" class="btn-delete" data-url="{{ route('recordings.destroy', $recording->id) }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form action="{{ route('recordings.destroy', $recording->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h1 class="text-center">{{ __('admin.No Recordings Found!') }}</h1>
                        @endforelse
                    </tbody>
                </table>
        </div>
     </div>
   

    @endsection
