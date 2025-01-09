@extends('layouts.master')

@section('page-title')
   {{__('admin.New Address')}}
@endsection


@section('page-content')

 <div class="card">
    <div class="card-body">
     <h1 class="text-center bg-primary text-white mt-3"><i class="ion-plus-circled"></i> {{__('admin.Add New Address')}}</h1>
     <form action="{{ route('addresses.store') }}" method="post" class="row">
      @csrf

    <div class="form-group col-12 mt-3">
       <label for="address">{{__('admin.Address')}}<span class="text-danger ms-2">*</span></label>
       <input type="text" name="address" id="address" class="form-control mt-2 @error('address') is-invalid @enderror">
    </div>

    <div class="form-group col-6">
        <label for="user_id">{{__('admin.Username')}}<span class="text-danger ms-2">*</span></label><br>
         <select name="user_id" id="user_id" class="form-select select2">
           @foreach ($users as $user)
           <option value="{{$user->id}}">{{ $user->name }}</option>
           @endforeach
         </select>
    </div>

    <div class="form-group col-6">
        <label for="city_id">{{__('admin.City')}}<span class="text-danger ms-2">*</span></label><br>
         <select name="city_id" id="city_id" class="form-select select2">
           @foreach ($cities as $city)
           <option value="{{$city->id}}">{{ $city->name }}</option>
           @endforeach
         </select>
    </div>

      <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary btn-lg">{{__('admin.Add')}}</button>
        <button type="reset" class="btn btn-secondary btn-lg">{{__('admin.Reset')}}</button>
      </div>

</form>
</div>
</div>
@endsection



