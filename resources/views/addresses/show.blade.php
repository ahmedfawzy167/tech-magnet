@extends('layouts.master')

@section('page-title')
   {{__('admin.Show Address')}}
@endsection

@section('page-content')

<div class="d-flex justify-content-center align-items-center vh-60 mt-3">
    <div class="card" style="width: 60rem;">
      <div class="card-body">
        <h2 class="card-title text-center bg-info text-white"><i class="fa-solid fa-eye"></i> {{__('admin.Address Details')}}</h2>
      </div>
      <ul class="list-group list-group-flush">
        <h6 class="list-group-item">{{__('admin.Location')}}: {{$address->address}}</h6>
        <h6 class="list-group-item">{{__('admin.Username')}}: {{$address?->user?->name}}</h6>
        <h6 class="list-group-item">{{__('admin.City')}}: {{$address?->city?->name}}</h6>
      </ul>
    </div>
  </div>
  
  <div class="text-center mt-2">
    <a href="{{route('addresses.index')}}" class="btn btn-info text-white">{{__('admin.Back to List')}}</a>
 </div>


@endsection
