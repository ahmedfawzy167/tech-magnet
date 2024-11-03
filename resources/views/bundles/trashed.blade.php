@extends('layouts.master')

@section('page-title')
    {{ __('admin.Trashed Bundles') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
        <div class="card-body">
             <h1 class="text-center bg-warning text-light"><i class="ion-alert"></i> {{ __('admin.All Trashed Bundles')}} </h1>
             <table class="table table-hover table-bordered mt-3" id="data-table">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">{{ __('admin.ID') }}</th>
                        <th class="text-center">{{ __('admin.Name') }}</th>
                        <th class="text-center">{{ __('admin.Description') }}</th>
                        <th class="text-center">{{ __('admin.Price') }}</th>
                        <th class="text-center">{{ __('admin.Courses') }}</th>
                        <th class="text-center">{{ __('admin.Image') }}</th>
                        <th>{{ __('admin.Actions') }}</th>
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
                                <td>
                                    @if($bundle->image)
                                        <img src="{{ asset('storage/' . $bundle->image->path) }}" width="70px" class="mr-2">
                                    @else
                                        <span class="badge bg-danger">{{__('admin.No Image Found!')}}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('restore-form-{{ $bundle->id }}').submit();">
                                        <i class="fa-solid fa-arrow-rotate-left text-success"></i>                                    
                                    </a>
                                    <form id="restore-form-{{ $bundle->id }}" action="{{ route('bundles.restore', $bundle->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                    </form>

                                    <a href="#" class="btn-delete-forever" data-url="{{ route('bundles.force-delete', $bundle->id) }}">
                                        <i class="fa-solid fa-trash-can text-danger ms-2"></i>
                                    </a>
                                    <form id="delete-form-{{ $bundle->id }}" action="{{ route('bundles.force-delete', $bundle->id) }}" method="post" style="display: none;">
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
