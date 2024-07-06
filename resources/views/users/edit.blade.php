@extends('layouts.master')

@section('page-title')
  {{__('admin.Edit User')}}
@endsection

@section('page-content')
<div class="card">
<div class="container card-body">
  <h1 class="text-center text-light bg-success"><i class="fa-solid fa-pen-to-square"></i> {{__('admin.Edit User')}}</h1>
  <form action="{{route('users.update',$user->id)}}" method="post" class="row">
    @csrf
    @method('PUT')

    <div class="form-group col-12">
      <label for="name"><i class="fa-solid fa-file-signature"></i> {{__('admin.User Name')}}</label>
      <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control @error('email') is-invalid @enderror">
      @error('name')
         <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="email"><i class="fa-solid fa-envelope"></i> {{__('admin.Email')}}</label>
        <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror">
        @error('email')
         <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group col-md-6">
        <label for="password"><i class="fa-solid fa-lock"></i> {{__('admin.Password')}}</label>
        <input type="password" name="password" id="password" value="{{$user->password}}" class="form-control @error('password') is-invalid @enderror">
        @error('password')
         <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group col-md-12">
        <label for="phone"><i class="fa-solid fa-lock"></i> {{__('admin.Phone')}}</label>
        <input type="number" name="phone" id="phone" value="{{$user->phone}}" class="form-control @error('phone') is-invalid @enderror">
        @error('phone')
         <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group col-md-12">
        <label for="role_id"> <i class="fa-solid fa-city"></i> {{__('admin.Role')}}</label>
        <select name="role_id" id="role_id" class="form-select">
            @foreach($roles as $role)
              <option value="{{$role->id}}" {{ $role->id == $user->role_id ? 'selected' : ''}}>{{$role->name}}</option>
            @endforeach
        </select>
      </div>

      <div class="form-group col-md-12">
        <label for="city_id"> <i class="fa-solid fa-city"></i> {{__('admin.City')}}</label>
        <select name="city_id" id="city_id" class="form-select">
            @foreach($cities as $city)
              <option value="{{$city->id}}"  {{ $city->id == $user->city_id ? 'selected' : ''}}>{{$city->name}}</option>
            @endforeach
        </select>
      </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">{{__('admin.Update')}}</button>
            <button type="reset" class="btn btn-secondary btn-lg">{{__('admin.Reset')}}</button>
        </div>

</form>


@endsection
