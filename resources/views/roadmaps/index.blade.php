@extends('layouts.master')

@section('page-title')
    {{ __('admin.All Roadmaps') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <h1 class="text-center bg-primary text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Roadmaps') }}
                </h1>
                <table class="table table-hover table-bordered" id="data-table">
                    <thead class="table-dark">
                        <tr>
                            <th>{{ __('admin.ID') }}</th>
                            <th>{{ __('admin.Title') }}</th>
                            <th>{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roadmaps as $roadmap)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $roadmap->title }}</td>
                                <td>
                                    <a href="{{ route('roadmaps.edit',$roadmap->id) }}"
                                        class="btn btn-success"><i class="fa-solid fa-file-signature"></i></a>
                                    <form action="{{ route('roadmaps.destroy',$roadmap->id) }}" method="post"
                                        style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"
                                            style="display: inline-block"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h1 class="text-center">No Skills Found!</h1>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

        @include('layouts.messages')


    @endsection
