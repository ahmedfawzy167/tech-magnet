@extends('layouts.master')

@section('page-title')
    {{__('admin.Trashed Categories') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
        <div class="card-body">
             <h1 class="text-center bg-warning text-light"><i class="ion-alert"></i> All Trashed Categories</h1>
             <table class="table table-hover table-bordered mt-3" id="data-table">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">{{ __('admin.ID') }}</th>
                        <th class="text-center">{{ __('admin.Name') }}</th>
                        <th class="text-center">{{ __('admin.Date') }}</th>
                        <th class="text-center">{{ __('admin.Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($trashedCategories as $category)
                            <tr>
                                <td class="text-center">{{ $loop->index+1 }}</td>
                                <td class="text-center">{{ $category->name }}</td>
                                <td class="text-center">{{\Carbon\Carbon::parse($category->created_at)->diffForHumans()}}</td>
                                <td class="text-center">
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('restore-form-{{ $category->id }}').submit();">
                                        <i class="fa-solid fa-arrow-rotate-left text-success"></i>                                    
                                    </a>
                                    <form id="restore-form-{{ $category->id }}" action="{{ route('categories.restore', $category->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                    </form>

                                    <a href="#" class="btn-delete-forever" data-url="{{ route('categories.force-delete', $category->id) }}">
                                        <i class="fa-solid fa-trash-can text-danger ms-2"></i>
                                    </a>
                                    <form id="delete-form-{{ $category->id }}" action="{{ route('categories.force-delete', $category->id) }}" method="post" style="display: none;">
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
