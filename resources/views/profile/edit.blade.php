@extends('layouts.master')

@section('page-title')
   {{__('admin.Profile')}}
@endsection

@section('page-content')
<div class="card">
 <h4 class="card-header bg-primary text-white text-center"><i class="fa-solid fa-gear"></i> {{__('admin.Edit Profile')}}</h4>
  <div class="card-body">
   <form method="POST" action="{{route('profile.update',$admin->id)}}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="email"><i class="fa-solid fa-envelope"></i> {{__('admin.Email')}}</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
        @error('email')
         <strong class="invalid-feedback" role="alert">{{__('validation.The email field is required.')}}</strong>
        @enderror
      </div>

     <div class="form-group">
      <label for="current_password"><i class="fa-solid fa-lock"></i> {{__('admin.Current Password')}}</label>
      <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
      @error('current_password')
        <strong class="invalid-feedback" role="alert">{{__('validation.The current password field is required.')}}</strong>
      @enderror
    </div>

<div class="form-group">
  <label for="new_password"><i class="fas fa-unlock-alt"></i> {{__('admin.New Password')}}</label>
  <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password">
    @error('new_password')
      <strong class="invalid-feedback" role="alert">{{__('validation.The new password field is required.')}}</strong>
    @enderror
</div>

<div class="form-group">
  <label for="new_password_confirmation"><i class="fas fa-clipboard-check"></i> {{__('admin.Confirm Password')}}</label>
  <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password_confirmation" name="new_password_confirmation">
  @error('new_password_confirmation')
    <strong class="invalid-feedback">{{ $message }}</strong>
  @enderror
</div>

<div class="text-center">
  <button type="submit" class="btn btn-primary btn-lg">{{__('admin.Save Changes')}}</button>
</div>

</form>

</div>
</div>

@include('layouts.messages')

@endsection
