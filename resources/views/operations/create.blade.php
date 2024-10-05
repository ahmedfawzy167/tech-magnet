@extends('layouts.master')

@section('page-title')
  {{__('admin.New Operation')}}
@endsection

@section('page-content')

<div class="card">
 <div class="card-body">
   <h1 class="text-center bg-primary text-white"><i class="ion-plus-circled"></i> {{__('admin.Add New Operation')}}</h1>
   <form action="{{ route('operations.store') }}" method="POST" class="row">
    @csrf
    <div class="form-group col-12">
      <label for="name"> {{__('admin.Name')}}<span class="text-danger ms-2">*</span></label>
      <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
      @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group col-6">
        <label for="email"> {{__('admin.Email')}}<span class="text-danger ms-2">*</span></label>
        <input type="email" name="email" id="email" value="{{old('email')}}"  class="form-control @error('email') is-invalid @enderror">
    </div>

      <div class="form-group col-6">
        <label for="password"> {{__('admin.Password')}}<span class="text-danger ms-2">*</span></label>
        <input type="password" name="password" id="password" value="{{old('password')}}"  class="form-control @error('password') is-invalid @enderror">
      </div>

      <div class="form-group col-12">
        <label for="phone">{{__('admin.Phone')}}<span class="text-danger ms-2">*</span></label>
        <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror">
      </div>

      <div class="form-group col-12">
        <label for="role_id"> {{__('admin.Role')}}<span class="text-danger ms-2">*</span></label>
        <select name="role_id" id="role_id" class="form-select">
            @foreach ($roles as $role)
              <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
        </select>
      </div>

      <div class="form-group col-12">
        <label for="city_id"> {{__('admin.City')}}<span class="text-danger ms-2">*</span></label>
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


