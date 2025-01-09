@extends('layouts.master')

@section('page-title')
   {{__('admin.Profile')}}
@endsection

@section('page-content')

<form method="POST" action="{{ route('profile.update',$admin->id) }}">
  @csrf
  @method('PUT')

<div class="card">
   <div class="card-body">
          <div class="form-group">
              <label for="name"><i class="fa-solid fa-user"></i> {{ __('admin.Name') }}</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $admin->name }}">
              @error('name')
                  <strong class="invalid-feedback" role="alert">{{ $message }}</strong>
              @enderror
          </div>

          <div class="form-group">
              <label for="email"><i class="fa-solid fa-envelope"></i> {{ __('admin.Email') }}</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $admin->email }}">
              @error('email')
                  <strong class="invalid-feedback" role="alert">{{ __('validation.The email field is required.') }}</strong>
              @enderror
          </div>
   </div>
</div>

<div class="card mt-5">
  <div class="card-body">
  <div class="form-group">
      <label for="current_password"><i class="fa-solid fa-lock"></i> {{ __('admin.Current Password') }}</label>
      <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
      @error('current_password')
          <strong class="invalid-feedback" role="alert">{{ __('validation.The current password field is required.') }}</strong>
      @enderror
  </div>

   <div class="form-group">
      <label for="new_password"><i class="fas fa-unlock-alt"></i> {{ __('admin.New Password') }}</label>
      <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password">
      @error('new_password')
          <strong class="invalid-feedback" role="alert">{{ __('validation.The new password field is required.') }}</strong>
      @enderror
   </div>

  <div class="form-group">
      <label for="new_password_confirmation"><i class="fas fa-clipboard-check"></i> {{ __('admin.Confirm Password') }}</label>
      <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="new_password_confirmation" name="new_password_confirmation">
      @error('new_password_confirmation')
          <strong class="invalid-feedback">{{ $message }}</strong>
      @enderror
  </div>

  </div>
</div>


<div class="text-center mt-2">
    <button type="submit" class="btn btn-primary">{{ __('admin.Save Changes') }}</button>
</div>

</form>
@endsection
