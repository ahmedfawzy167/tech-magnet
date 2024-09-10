@extends('layouts.master')

@section('page-title')
    {{__('admin.Trashed Categories') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
        <div class="card-body">
             <h1 class="text-center bg-warning text-light"><i class="ion-alert"></i> All Trashed Categories</h1>
             <table class="table table-hover table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>{{ __('admin.ID') }}</th>
                        <th>{{ __('admin.Name') }}</th>
                        <th>{{ __('admin.Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($trashedCategories as $category)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('restore-form-{{ $category->id }}').submit();">
                                        <i class="fa-solid fa-arrow-rotate-left text-success"></i>                                    
                                    </a>
                                    <form id="restore-form-{{ $category->id }}" action="{{ route('categories.restore', $category->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                    </form>

                                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $category->id }}').submit();">
                                        <i class="fa-solid fa-trash-can text-danger ms-2"></i>                                    
                                    </a>
                                    <form id="delete-form-{{ $category->id }}" action="{{ route('categories.force-delete', $category->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <div>
                             <td colspan="3">
                               <h1 class="text-center alert alert-warning">{{ __('admin.No Trashed Categories Found!')}}</h1>
                            </td>
                           </div>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
        </div>
    </div>


    @endsection
