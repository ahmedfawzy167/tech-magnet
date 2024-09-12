@extends('layouts.master')

@section('page-title')
    {{ __('admin.All Roadmaps') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
         <div class="card-body">
                <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Roadmaps') }}</h1>
                <table class="table table-hover table-bordered" id="data-table">
                    <thead class="table-dark">
                        <tr>
                            <th>{{ __('admin.ID') }}</th>
                            <th>{{ __('admin.Title') }}</th>
                            <th>{{__('admin.Description')}}</th>
                            <th>{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roadmaps as $roadmap)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $roadmap->title }}</td>
                                <td>{{ \Str::limit($roadmap->description,30) }}</td>
                                <td>
                                    <a href="{{ route('roadmaps.edit', $roadmap->id) }}"><i class="fa-solid fa-file-signature text-success"></i></a>
                                    <a href="#" class="btn-delete" data-url="{{ route('roadmaps.destroy', $roadmap->id) }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form action="{{ route('roadmaps.destroy', $roadmap->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h1 class="text-center">{{ __('admin.No Roadmaps Found!') }}</h1>
                        @endforelse
                    </tbody>
                </table>


        </div>
        </div>

    @endsection
