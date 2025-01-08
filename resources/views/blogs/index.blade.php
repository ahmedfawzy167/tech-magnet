@extends('layouts.master')

@section('page-title')
  {{__('admin.Blogs')}}
@endsection

@section('page-content')
<div class="card">
  <div class="card-body">
          <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{__('admin.All Blogs')}}</h1>
          <table class="table table-hover table-bordered" id="data-table">
            <thead class="table-dark">
              <tr>
                <th class="text-center">{{__('admin.ID')}}</th>
                <th class="text-center">{{__('admin.Title')}}</th>
                <th class="text-center">{{__('admin.Description')}}</th>
                <th class="text-center">{{__('admin.Image')}}</th>
                <th class="text-center">{{__('admin.Actions')}}</th>
              </tr>
            </thead>
             <tbody>
                @foreach($blogs as $blog)
                 <tr>
                  <td class="text-center">{{$loop->iteration}}</td>
                  <td class="text-center">{{$blog->title}}</td>
                  <td class="text-center">{{\Str::limit($blog->description,20)}}</td>
                  <td class="text-center">
                    @if($blog?->image)
                        <img src="{{ asset('storage/blogs/' . $blog->id . '/' . $blog->image->path) }}" width="70px" class="mr-2">
                    @else
                        <span class="badge bg-danger">{{ __('admin.No Image Available') }}</span>
                    @endif
                  </td>
                  <td class="text-center">
                    <a href="{{ route('blogs.show', $blog->id) }}"><i class="fa-solid fa-eye text-info"></i></a>
                    <a href="{{ route('blogs.edit', $blog->id) }}"><i class="fa-solid fa-file-signature text-success"></i></a>
                    <a href="#" class="btn-delete" data-url="{{ route('blogs.destroy', $blog->id) }}">
                        <i class="fa-solid fa-trash text-danger"></i>
                    </a>
                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="post" style="display: none;">
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

