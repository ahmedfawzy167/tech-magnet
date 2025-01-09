@extends('layouts.master')

@section('page-title')
  {{__('admin.Edit Setting')}}
@endsection

@section('page-content')

<div class="card">
  <div class="card-body">
    <h1 class="text-center bg-success text-white"><i class="fa-solid fa-pen-to-square"></i> {{__('admin.Edit Setting')}}</h1>
    <form action="{{route('settings.update',$setting->id)}}" method="post" enctype="multipart/form-data" class="row">
      @csrf
      @method('PUT')

    <div class="form-group col-md-12">
      <label for="logo">{{__('admin.Image')}}<span class="text-danger ms-2">*</span></label>
      <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror">
      <img src="{{ asset('storage/'.$setting->logo) }}" width="50px" class="rounded-circle">
    </div>

    <div class="form-group col-md-12">
      <label for="email">{{__('admin.Email')}}<span class="text-danger ms-2">*</span></label>
      <input type="email" name="email" value="{{$setting->email}}" id="email" class="form-control @error('email') is-invalid @enderror">
    </div>

    <div class="form-group col-12">
      <label for="phone">{{__('admin.Phone')}}<span class="text-danger ms-2">*</span></label>
      <input type="number" name="phone" value="{{$setting->phone}}" id="phone" class="form-control @error('phone') is-invalid @enderror">
    </div>

      <div class="form-group col-12">
        <label for="location">{{__('admin.Location')}}<span class="text-danger ms-2">*</span></label>
        <input type="text" name="location" value="{{$setting->location}}" id="location" class="form-control @error('location') is-invalid @enderror">
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-primary btn-lg">{{__('admin.Update')}}</button>
      </div>
</form>

</div>

</div>

@endsection



