@extends('layouts.master')

@section('page-title')
    {{ __('admin.Bundles') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
        <div class="card-body">
             <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Bundles') }}</h1>
             <table class="table table-hover table-bordered" id="data-table">
                <thead class="table-dark">
                       <tr>
                            <th class="text-center">{{ __('admin.ID') }}</th>
                            <th class="text-center">{{ __('admin.Name') }}</th>
                            <th class="text-center">{{ __('admin.Description') }}</th>
                            <th class="text-center">{{ __('admin.Price') }}</th>
                            <th class="text-center">{{ __('admin.Courses') }}</th>
                            <th class="text-center">{{ __('admin.Image') }}</th>
                            <th class="text-center">{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bundles as $bundle)
                            <tr>
                                <td class="text-center">{{ $loop->index+1 }}</td>
                                <td class="text-center">{{ $bundle->name }}</td>
                                <td class="text-center">{{ $bundle->description }}</td>
                                <td class="text-center">{{ $bundle->price }}</td>
                                <td class="text-center" data-bs-toggle="tooltip" data-bs-html="true" title="{{ implode(', ', $bundle->courses->pluck('name')->toArray()) }}">
                                    {{ $bundle->courses->count() }}
                                </td>
                                <td class="text-center">
                                    @if($bundle?->image)
                                        <img src="{{ asset('storage/bundles/' . $bundle->id . '/' . $bundle->image->path) }}" width="70px" class="mr-2">
                                    @else
                                        <span class="badge bg-danger">{{ __('admin.No Image Available') }}</span>
                                    @endif
                                  </td>
                                <td class="text-center">
                                    <a href="{{ route('bundles.show', $bundle->id) }}"><i class="fa-solid fa-eye text-info"></i></a>
                                    <a href="{{ route('bundles.edit', $bundle->id) }}"><i class="fa-solid fa-file-signature text-success"></i></a>
                                    <a href="#" class="btn-delete" data-url="{{ route('bundles.destroy', $bundle->id) }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form action="{{ route('bundles.destroy', $bundle->id) }}" method="post" style="display: none;">
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

@section('page-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>

@endsection
