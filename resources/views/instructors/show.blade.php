@extends('layouts.master')

@section('page-title')
   {{__('admin.Show Instructor')}}
@endsection

@section('page-content')

<div class="d-flex justify-content-center align-items-center vh-60">
    <div class="card" style="width: 60rem;">
      <div class="card-body">
        <h2 class="card-title text-center bg-info text-white"><i class="fa-solid fa-eye"></i> {{__('admin.Instructor Details')}}</h2>
      </div>
      <ul class="list-group list-group-flush">
        <h4 class="list-group-item">{{__('admin.Name')}}: {{$instructor->name}}</h4>
        <h4 class="list-group-item">{{__('admin.Email')}}: {{$instructor->email}}</h4>
        <h4 class="list-group-item">{{__('admin.Phone')}}: {{$instructor->phone}}</h4>
        <h4 class="list-group-item">{{__('admin.Role')}}: {{$instructor->role->name}}</h4>
        <h4 class="list-group-item">{{__('admin.City')}}: {{$instructor->city->name}}</h4>
        <h4 class="list-group-item">{{ __('admin.Addresses') }}:
          @if ($instructor->addresses->isEmpty())
            <li class="badge bg-danger">{{ __('admin.No Address Defined!') }}</li>
          @else
              @foreach ($instructor->addresses as $address)
                  <li class="ms-4">{{ $address?->address }}</li>
              @endforeach
          @endif
      </h4>
     </ul>
    </div>
  </div>
  <div class="text-center">
     <a href="{{route('instructors.index')}}" class="btn btn-info mt-2">{{__('admin.Back to List')}}</a>
  </div>

@endsection
