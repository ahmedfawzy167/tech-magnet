@extends('layouts.master')

@section('page-title')
    All Trashed Categories
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
                        <th>{{ __('admin.Description') }}</th>
                        <th>{{ __('admin.Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($trashedBlogs as $blog)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $blog->title }}</td>
                                <td>{{\Str::limit($blog->description,10)}}</td>
                                <td>
                                    <form action="{{ route('blogs.restore', $blog->id) }}" method="post" style="display: inline-block;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success"><i class="ion-loop"></i> Restore</button>
                                    </form>
                                
                                    <form action="{{ route('blogs.force-delete', $blog->id) }}" method="post" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="ion-trash-a"></i> Force Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <div>
                             <td colspan="4">
                               <h1 class="text-center alert alert-warning">No Trashed Blogs Found!</h1>
                            </td>
                           </div>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
        </div>
    </div>

        @include('layouts.messages')


    @endsection
