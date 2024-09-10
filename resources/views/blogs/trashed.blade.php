@extends('layouts.master')

@section('page-title')
    {{ __('admin.Trashed Blogs') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
        <div class="card-body">
             <h1 class="text-center bg-warning text-light"><i class="ion-alert"></i> {{ __('admin.All Trashed Blogs') }}</h1>
             <table class="table table-hover table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>{{ __('admin.ID') }}</th>
                        <th>{{ __('admin.Name') }}</th>
                        <th>{{ __('admin.Description') }}</th>
                        <th>{{ __('admin.Image') }}</th>
                        <th>{{ __('admin.Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($trashedBlogs as $blog)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $blog->title }}</td>
                                <td>{{\Str::limit($blog->description,20)}}</td>
                                <td>
                                    @if($blog->image)
                                      <img src="{{ asset('storage/' . $blog->image->path) }}" width="70px" class="mr-2">
                                    @endif
                                </td>
                                <td>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('restore-form-{{ $blog->id }}').submit();">
                                        <i class="fa-solid fa-arrow-rotate-left text-success"></i>                                    
                                    </a>
                                    <form id="restore-form-{{ $blog->id }}" action="{{ route('blogs.restore', $blog->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                    </form>

                                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $blog->id }}').submit();">
                                        <i class="fa-solid fa-trash-can text-danger ms-2"></i>                                    
                                    </a>
                                    <form id="delete-form-{{ $blog->id }}" action="{{ route('blogs.force-delete', $blog->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <div>
                             <td colspan="4">
                               <h1 class="text-center alert alert-warning">{{ __('admin.No Trashed Blogs Found!') }}</h1>
                            </td>
                           </div>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
        </div>
    </div>


    @endsection
