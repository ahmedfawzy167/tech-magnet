@extends('layouts.master')

@section('page-title')
{{__('admin.All Blogs')}}
@endsection

@section('page-content')
        <div class="table-responsive">
          <h1 class="text-center bg-dark text-light mt-2"><i class="fa-solid fa-list"></i> {{__('admin.All Blogs')}}</h1>
          <table class="table table-hover table-bordered mt-3" id="data-table">
            <thead class="table-dark">
              <tr>
                <th>{{__('admin.ID')}}</th>
                <th>{{__('admin.Title')}}</th>
                <th>{{__('admin.Image')}}</th>
                <th>{{__('admin.Actions')}}</th>
              </tr>
            </thead>
             <tbody>
                @foreach($blogs as $blog)
                 <tr>
                  <td>{{$blog->id}}</td>
                  <td>{{$blog->title}}</td>
                  <td>
                    @if($blog->image)
                        <img src="{{ asset('storage/' . $blog->image->path) }}" width="70px" class="mr-2">
                    @endif
                </td>
                  <td>
                    <a href="{{ route('blogs.show',$blog->id) }}" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{ route('blogs.edit',$blog->id) }}" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="{{route('blogs.destroy' ,$blog->id)}}" method="post" style="display: inline-block">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-danger" style="display: inline-block"><i class="fa-solid fa-trash"></i></button>
                    </form>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                
        </div>

@include('layouts.messages')
@endsection

