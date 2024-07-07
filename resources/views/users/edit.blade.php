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
      <label for="name">{{__('admin.Name')}}<span class="text-danger ms-2">*</span></label>
      <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control @error('email') is-invalid @enderror">
      @error('name')
         <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="email">{{__('admin.Email')}}<span class="text-danger ms-2">*</span></label>
        <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror">
        @error('email')
         <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group col-md-6">
        <label for="password">{{__('admin.Password')}}<span class="text-danger ms-2">*</span></label>
        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
        @error('password')
         <div class="invalid-feedback">{{ $message }}<span class="text-danger ms-2">*</span></div>
        @enderror
      </div>

      <div class="form-group col-md-12">
        <label for="phone">{{__('admin.Phone')}}<span class="text-danger ms-2">*</span></label>
        <input type="number" name="phone" id="phone" value="{{$user->phone}}" class="form-control @error('phone') is-invalid @enderror">
        @error('phone')
         <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group col-md-12">
        <label for="role_id">{{__('admin.Role')}}<span class="text-danger ms-2">*</span></label>
        <select name="role_id" id="role_id" class="form-select">
            @foreach($roles as $role)
              <option value="{{$role->id}}" {{ $role->id == $user->role_id ? 'selected' : ''}}>{{$role->name}}</option>
            @endforeach
        </select>
      </div>

      <div class="form-group col-md-12">
        <label for="city_id">{{__('admin.City')}}<span class="text-danger ms-2">*</span></label>
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
