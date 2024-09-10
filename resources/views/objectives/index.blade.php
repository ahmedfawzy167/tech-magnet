@extends('layouts.master')

@section('page-title')
    {{ __('admin.All Objectives') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
         <div class="card-body">
                <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Objectives') }}
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
                        @forelse($objectives as $objective)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $objective->name }}</td>
                                <td>
                                    <a href="{{ route('objectives.show', $objective->id) }}"><i class="fa-solid fa-eye text-info"></i></a>
                                    <a href="{{ route('objectives.edit', $objective->id) }}"><i class="fa-solid fa-file-signature text-success"></i></a>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $objective->id }}').submit();">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form id="delete-form-{{ $objective->id }}" action="{{ route('objectives.destroy', $objective->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h1 class="text-center">No Objectives Found!</h1>
                        @endforelse
                    </tbody>
                </table>
        </div>
        </div>


    @endsection
