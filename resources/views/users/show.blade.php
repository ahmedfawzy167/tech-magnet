@extends('layouts.master')

@section('page-title')
   {{__('admin.Show User')}}
@endsection

@section('page-content')

<div class="d-flex justify-content-center align-items-center vh-60">
    <div class="card" style="width: 60rem;">
      <div class="card-body">
        <h2 class="card-title text-center bg-info text-white"><i class="fa-solid fa-eye"></i> {{__('admin.User Details')}}</h2>
      </div>
      <ul class="list-group list-group-flush">
        <h4 class="list-group-item">{{__('admin.User Name')}}: {{$user->name}}</h4>
        <h4 class="list-group-item">{{__('admin.Email')}}: {{$user->email}}</h4>
        <h4 class="list-group-item">{{__('admin.Email')}}: {{$user->phone}}</h4>
        <h4 class="list-group-item">{{__('admin.Role')}}: {{$user->role->name}}</h4>
        <h4 class="list-group-item">{{__('admin.City')}}: {{$user->city->name}}</h4>
     </ul>
    </div>
  </div>
  <div class="text-center">
     <a href="{{route('users.index')}}" class="btn btn-info mt-2">{{__('admin.Back to List')}}</a>
  </div>


@endsection
