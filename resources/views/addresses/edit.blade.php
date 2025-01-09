@extends('layouts.master')

@section('page-title')
   {{__('admin.Edit Address')}}
@endsection


@section('page-content')

 <div class="card">
    <div class="card-body">
     <h1 class="text-center bg-primary text-white mt-3"><i class="ion-plus-circled"></i> {{__('admin.Edit Address')}}</h1>
     <form action="{{ route('addresses.update',$address->id) }}" method="post" class="row">
      @csrf
      @method('PUT')

    <div class="form-group col-12 mt-3">
       <label for="address">{{__('admin.Address')}}<span class="text-danger ms-2">*</span></label>
       <input type="text" name="address" id="address" value="{{ $address->address }}" class="form-control mt-2 @error('address') is-invalid @enderror">
    </div>

    <div class="form-group col-6">
        <label for="user_id">{{__('admin.Username')}}<span class="text-danger ms-2">*</span></label><br>
         <select name="user_id" id="user_id" class="form-select select2">
           @foreach ($users as $user)
           <option value="{{$user->id}}" @selected($user->id == $address->user_id)>{{ $user->name }}</option>
           @endforeach
         </select>
    </div>

    <div class="form-group col-6">
        <label for="city_id">{{__('admin.City')}}<span class="text-danger ms-2">*</span></label><br>
         <select name="city_id" id="city_id" class="form-select select2">
           @foreach ($cities as $city)
           <option value="{{$city->id}}" @selected($city->id == $address->city_id)>{{ $city->name }}</option>
           @endforeach
         </select>
    </div>

      <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary btn-lg">{{__('admin.Update')}}</button>
      </div>

</form>
</div>
</div>
@endsection



