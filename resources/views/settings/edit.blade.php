@extends('layouts.master')

@section('page-title')
{{__('admin.Edit Setting')}}
@endsection

@section('page-content')

<div class="card">
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="container card-body">
  <h1 class="text-center bg-success text-white"><i class="fa-solid fa-pen-to-square"></i> {{__('admin.Edit Setting')}}</h1>
  <form action="{{route('settings.update',$setting->id)}}" method="post" enctype="multipart/form-data" class="row">
    @method('PUT')
    @csrf

    <div class="form-group col-md-12">
      <label for="logo">{{__('admin.Image')}}</label>
      <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror">
      @error('logo')
        <strong class="invalid-feedback">{{ $message }}</strong>
      @enderror
    </div>

    <div class="form-group col-md-12">
      <label for="email">{{__('admin.Email')}}</label>
      <input type="email" name="email" value="{{$setting->email}}" id="email" class="form-control @error('email') is-invalid @enderror">
      @error('email')
        <strong class="invalid-feedback">{{ $message }}</strong>
      @enderror
    </div>

    <div class="col-12">
      <label for="phone">{{__('admin.Phone')}}</label>
      <input type="number" name="phone" value="{{$setting->phone}}" id="phone" class="form-control @error('phone') is-invalid @enderror">
      @error('phone')
        <strong class="invalid-feedback">{{ $message }}</strong>
      @enderror
      </div>

      <div class="form-group col-md-12">
        <label for="location">{{__('admin.Location')}}</label>
        <input type="text" name="location" value="{{$setting->location}}" id="location" class="form-control @error('location') is-invalid @enderror">
        @error('location')
          <strong class="invalid-feedback">{{ $message }}</strong>
        @enderror
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-primary btn-lg">{{__('admin.Update')}}</button>
        <button type="reset" class="btn btn-secondary btn-lg">{{__('admin.Reset')}}</button>
    </div>

</form>
</div>
</div>

@endsection
