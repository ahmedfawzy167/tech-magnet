@extends('layouts.master')

@section('page-title')
{{__('admin.Show Role')}}
@endsection

@section('page-content')

<div class="d-flex justify-content-center align-items-center vh-60 mt-3">
    <div class="card" style="width: 60rem;">
      <div class="card-body">
        <h2 class="card-title text-center bg-success text-white"><i class="fa-solid fa-eye"></i> {{__('admin.Show Role')}}</h2>
      </div>
      <ul class="list-group list-group-flush">
        <h6 class="list-group-item">{{__('admin.Name')}}: {{$role->name}}</h6>
        <h6 class="list-group-item">{{__('admin.Users')}}:
            @foreach ($users as $user)
             <div class="ms-4">
                <li>{{$user->name}}</li>
            @endforeach
           </div>
        </h6>

      </ul>
    </div>
  </div>
  <div class="text-center mt-3">
    <a href="{{route('categories.index')}}" class="btn btn-success text-white">{{__('admin.Back to List')}}</a>
 </div>


@endsection
