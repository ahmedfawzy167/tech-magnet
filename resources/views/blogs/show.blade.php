@extends('layouts.master')

@section('page-title')
   {{__('admin.Show Blog')}}
@endsection

@section('page-content')

<div class="d-flex justify-content-center align-items-center vh-60 mt-3">
    <div class="card" style="width: 60rem;">
      <div class="card-body">
        <h2 class="card-title text-center bg-info text-white"><i class="fa-solid fa-eye"></i> {{__('admin.Show Blog')}}</h2>
      </div>
      <ul class="list-group list-group-flush">
        <h6 class="list-group-item">{{__('admin.Title')}}: {{$blog->title}}</h6>
        <h6 class="list-group-item">{{__('admin.Description')}}: {{$blog->description}}</h6>
        <h6 class="list-group-item">{{__('admin.Image')}}: <img src="{{asset('storage/'.$blog->image->path)}}" width="100px" class="rounded-circle ms-3"></h6>
      </ul>
    </div>
  </div>
  <div class="text-center mt-2">
    <a href="{{route('blogs.index')}}" class="btn btn-info text-white">{{__('admin.Back to List')}}</a>
 </div>


@endsection
