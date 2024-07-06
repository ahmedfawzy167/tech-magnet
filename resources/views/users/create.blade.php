@extends('layouts.master')

@section('page-title')
  {{__('admin.New User')}}
@endsection

@section('page-content')

<div class="card">
 <div class="card-body container">
   <h1 class="text-center bg-primary text-white"><i class="ion-plus-circled"></i> {{__('admin.Add New User')}}</h1>
   <form action="{{ route('users.store') }}" method="POST" class="row">
    @csrf
    <div class="form-group col-md-12">
      <label for="name"> {{__('admin.User Name')}}</label>
      <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
      @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="email"> {{__('admin.Email')}}</label>
        <input type="email" name="email" id="email" value="{{old('email')}}"  class="form-control @error('email') is-invalid @enderror">
        @error('email')
         <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group col-md-6">
        <label for="password"> {{__('admin.Password')}}</label>
        <input type="password" name="password" id="password" value="{{old('password')}}"  class="form-control @error('password') is-invalid @enderror">
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group col-md-12">
        <label for="phone">{{__('admin.Phone')}}</label>
        <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror">
        @error('phone')
         <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group col-md-12">
        <label for="role_id"> {{__('admin.Role')}}</label>
        <select name="role_id" id="role_id" class="form-select">
            @foreach ($roles as $role)
              <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
        </select>

      </div>

      <div class="form-group col-md-12">
        <label for="city_id"> {{__('admin.City')}}</label>
        <select name="city_id" id="city_id" class="form-select">
            @foreach ($cities as $city)
              <option value="{{$city->id}}">{{$city->name}}</option>
            @endforeach
        </select>

      </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">{{__('admin.Add')}}</button>
            <button type="reset" class="btn btn-secondary btn-lg">{{__('admin.Reset')}}</button>
        </div>

</form>
</div>
</div>

@endsection
