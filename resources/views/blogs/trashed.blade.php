@extends('layouts.master')

@section('page-title')
    {{ __('admin.Trashed Blogs') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
        <div class="card-body">
             <h1 class="text-center bg-warning text-light"><i class="ion-alert"></i> {{ __('admin.All Trashed Blogs') }}</h1>
             <table class="table table-hover table-bordered mt-3" id="data-table">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">{{ __('admin.ID') }}</th>
                        <th class="text-center">{{ __('admin.Name') }}</th>
                        <th class="text-center">{{ __('admin.Description') }}</th>
                        <th class="text-center">{{ __('admin.Image') }}</th>
                        <th class="text-center">{{ __('admin.Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($trashedBlogs as $blog)
                            <tr>
                                <td class="text-center">{{ $loop->index+1 }}</td>
                                <td class="text-center">{{ $blog->title }}</td>
                                <td class="text-center">{{\Str::limit($blog->description,20)}}</td>
                                <td class="text-center">
                                    @if($blog?->image)
                                    <img src="{{ asset('storage/' . $blog->image->path) }}" width="70px" class="mr-2">
                                  @else
                                    <span class="badge bg-danger">{{__('admin.No Image Found!')}}</span>
                                  @endif
                                </td>
                                <td class="text-center">
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('restore-form-{{ $blog->id }}').submit();">
                                        <i class="fa-solid fa-arrow-rotate-left text-success"></i>                                    
                                    </a>
                                    <form id="restore-form-{{ $blog->id }}" action="{{ route('blogs.restore', $blog->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                    </form>

                                    <a href="#" class="btn-delete-forever" data-url="{{ route('blogs.force-delete', $blog->id) }}">
                                        <i class="fa-solid fa-trash-can text-danger ms-2"></i>
                                    </a>
                                    <form id="delete-form-{{ $blog->id }}" action="{{ route('blogs.force-delete', $blog->id) }}" method="post" style="display: none;">
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
