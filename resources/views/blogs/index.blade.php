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
                <th>{{__('admin.ID')}}</th>
                <th>{{__('admin.Title')}}</th>
                <th>{{__('admin.Description')}}</th>
                <th>{{__('admin.Image')}}</th>
                <th>{{__('admin.Actions')}}</th>
              </tr>
            </thead>
             <tbody>
                @foreach($blogs as $blog)
                 <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$blog->title}}</td>
                  <td>{{\Str::limit($blog->description,20)}}</td>
                  <td>
                    @if($blog->image)
                        <img src="{{ asset('storage/' . $blog->image->path) }}" width="70px" class="mr-2">
                    @endif
                </td>
                  <td>
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

