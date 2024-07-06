@extends('layouts.master')

@section('page-title')
   {{__('admin.Show Material')}}
@endsection

@section('page-content')

<div class="d-flex justify-content-center align-items-center vh-60">
    <div class="card" style="width: 60rem;">
      <div class="card-body">
        <h2 class="card-title text-center bg-info text-white"><i class="fa-solid fa-eye"></i>   {{__('admin.Material Details')}}</h2>
      </div>
      <ul class="list-group list-group-flush">
        <h4 class="list-group-item">  {{__('admin.Title')}}: {{$material->title}}</h4>
        <h4 class="list-group-item">  {{__('admin.Description')}}: {{$material->description}}</h4>
        <h4 class="list-group-item">  {{__('admin.File Type')}}: {{$material->file_type}}</h4>
        <h4 class="list-group-item">{{__('admin.Course')}}: {{$material->course->name}}</h4>
      </ul>
    </div>
  </div>
  <div class="text-center">
     <a href="{{route('materials.index')}}" class="btn btn-info mt-2">{{__('admin.Back to List')}}</a>
  </div>

@endsection
