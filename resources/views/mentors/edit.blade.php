@extends('layouts.master')

@section('page-title')
  {{__('admin.Edit Mentor')}}
@endsection

@section('page-content')

<div class="card">
 <div class="card-body">
  <h1 class="text-center text-light bg-success"><i class="fa-solid fa-pen-to-square"></i> {{__('admin.Edit Mentor')}}</h1>
  <form action="{{route('mentors.update',$mentor->id)}}" method="post" class="row">
    @csrf
    @method('PUT')

    <div class="form-group col-12">
      <label for="name">{{__('admin.Name')}}<span class="text-danger ms-2">*</span></label>
      <input type="text" name="name" id="name" value="{{$mentor->name}}" class="form-control @error('email') is-invalid @enderror">
    </div>

    <div class="form-group col-6">
        <label for="email">{{__('admin.Email')}}<span class="text-danger ms-2">*</span></label>
        <input type="email" name="email" id="email" value="{{$mentor->email}}" class="form-control @error('email') is-invalid @enderror">
      </div>

      <div class="form-group col-6">
        <label for="password">{{__('admin.Password')}}<span class="text-secondary ms-2">(Nullable)</span></label>
        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
      </div>

      <div class="form-group col-12">
        <label for="phone">{{__('admin.Phone')}}<span class="text-danger ms-2">*</span></label>
        <input type="number" name="phone" id="phone" value="{{$mentor->phone}}" class="form-control @error('phone') is-invalid @enderror">
      </div>

      <div class="form-group col-12">
        <label for="role_id">{{__('admin.Role')}}<span class="text-danger ms-2">*</span></label>
        <select name="role_id" id="role_id" class="select2 form-select">
            @foreach($roles as $role)
              <option value="{{$role->id}}" {{ $mentor->hasRole($role->name) ? 'selected' : '' }}>{{$role->name}}</option>
            @endforeach
        </select>
      </div>


        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">{{__('admin.Update')}}</button>
        </div>
</form>
</div>
</div>
@endsection



    

