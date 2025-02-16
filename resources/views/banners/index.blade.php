@extends('layouts.master')

@section('page-title')
    {{ __('admin.Banners') }}
@endsection

@section('page-content')
<div class="row">
    <div class="card">
    <div class="card-body">
         <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Banners') }}</h1>
         <table class="table table-hover table-bordered" id="data-table">
            <thead class="table-dark">
                   <tr>
                        <th class="text-center">{{ __('admin.ID') }}</th>
                        <th class="text-center">{{ __('admin.Name') }}</th>
                        <th class="text-center">{{ __('admin.Location') }}</th>
                        <th class="text-center">{{ __('admin.Image') }}</th>
                        <th class="text-center">{{ __('admin.Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banners as $banner)
                        <tr>
                            <td class="text-center">{{ $loop->index+1 }}</td>
                            <td class="text-center">{{ $banner?->name }}</td>
                            <td class="text-center">
                                @if($banner->locations->isNotEmpty())
                                    @foreach($banner->locations as $location)
                                        <span class="badge bg-primary px-2 py-1 me-1">
                                            <i class="fa-solid fa-map-marker-alt"></i> {{ $location->name }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="badge bg-secondary">{{ __('admin.No Location Assigned') }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($banner?->image)
                                <img src="{{ getPath('banners', $banner->id, $banner->image->path) }}" width="70px" class="mr-2">
                                @else
                                    <span class="badge bg-danger">{{ __('admin.No Image Available') }}</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <a href="{{ route('banners.edit', $banner->id) }}"><i class="fa-solid fa-file-signature text-success"></i></a>
                                <a href="#" class="btn-delete" data-url="{{ route('banners.destroy', $banner->id) }}">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </a>
                                <form action="{{ route('banners.destroy', $banner->id) }}" method="post" style="display: none;">
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


