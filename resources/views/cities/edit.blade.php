@extends('layouts.master')

@section('page-title')
   {{__('admin.Edit City')}}
@endsection

@section('page-content')
<div class="card">

<div class="container card-body">
 <h1 class="text-center text-light bg-success"><i class="fa-solid fa-pen-to-square"></i> {{trans('admin.Edit City')}}</h1>
 <form action="{{route('cities.update',$city->id)}}" method="post" class="row">
    @csrf
    @method('PUT')
    <div class="form-group col-md-12">
      <label for="name">{{__('admin.City Name')}}</label>
      <input type="text" name="name" id="name" value="{{$city->name}}" class="form-control @error('name') is-invalid @enderror">
      @error('name')
        <strong class="invalid-feedback">{{ $message }}</strong>
      @enderror
    </div>

     <div class="text-center">
        <button type="submit" class="btn btn-primary btn-lg">{{__('admin.Save Changes')}}</button>
        <button type="reset" class="btn btn-secondary btn-lg">{{__('admin.Reset')}}</button>
    </div>

</form>
</div>
</div>

@endsection
