@extends('layouts.master')

@section('page-title')
  {{__('admin.Show Admin')}}
@endsection

@section('page-content')

<div class="d-flex justify-content-center align-items-center vh-60">
    <div class="card" style="width: 60rem;">
      <div class="container card-body">
        <h2 class="card-title text-center bg-primary text-white"><i class="fa-solid fa-eye"></i> {{__('admin.Admin Details')}}</h2>
      </div>
      <ul class="list-group list-group-flush">
        <h2 class="list-group-item">{{__('admin.Name')}}: {{ $admin->name}}</h2>
        <h2 class="list-group-item">{{__('admin.Email')}}: {{ $admin->email}}</h2>
      </ul>
    </div>
  </div>
  <div class="text-center my-2">
    <a href="{{route('profile.edit')}}" class="btn btn-primary btn btn-lg">{{__('admin.Edit Profile')}}</a>
 </div>


@endsection
