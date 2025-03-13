@extends('layouts.master')

@section('page-title')
   {{ __('admin.Profile') }}
@endsection

@section('page-content')

<form method="POST" action="{{ route('profile.update', $admin->id) }}" enctype="multipart/form-data" class="row">
  @csrf
  @method('PUT')

 
  <div class="card">
    <div class="card-body">
        <div class="position-relative d-inline-block">
            <img id="imagePreview" 
                 src="{{ auth()->guard('admin')->user()->image ? getPath('admins', auth()->guard('admin')->user()->id, auth()->guard('admin')->user()->image->path) : asset('assets/img/undraw_profile.svg') }}" 
                 class="rounded-circle border shadow" 
                 width="150px" height="150px" 
                 style="object-fit: cover;">

            <input type="file" name="images" id="imageInput" accept=".jpg,.jpeg,.png" class="d-none" onchange="previewImage(event)">

            <button type="button" class="btn btn-primary mt-3" onclick="document.getElementById('imageInput').click();">
                <i class="fa-solid fa-camera"></i> {{ __('admin.Upload New Image') }}
            </button>

             <p class="mt-2 fw-bold text-muted">{{ __('admin.Allowed Extensions: JPG, JPEG, PNG') }}</p>
        </div>

        @error('images')
            <strong class="invalid-feedback d-block">{{ $message }}</strong>
        @enderror
    </div>
</div>



  <div class="card mt-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"><i class="fa-solid fa-user"></i> {{ __('admin.Name') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $admin->name }}">
                    @error('name')
                        <strong class="invalid-feedback">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="email"><i class="fa-solid fa-envelope"></i> {{ __('admin.Email') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $admin->email }}">
                    @error('email')
                        <strong class="invalid-feedback">{{ __('validation.The email field is required.') }}</strong>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="phone"><i class="fa-solid fa-phone"></i> {{ __('admin.Phone') }}</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $admin->phone }}">
                    @error('phone')
                        <strong class="invalid-feedback">{{ $message }}</strong>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="country_id"><i class="fa-solid fa-flag"></i> {{ __('admin.Country') }}</label>
                    <select class="form-control @error('country_id') is-invalid @enderror" id="country_id" name="country_id">
                        <option value="">{{ __('admin.Select Country') }}</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" @selected($admin->country_id == $country->id)>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('country_id')
                        <strong class="invalid-feedback">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="city_id"><i class="fa-solid fa-city"></i> {{ __('admin.City') }}</label>
                    <select class="form-control @error('city_id') is-invalid @enderror" id="city_id" name="city_id">
                        <option value="">{{ __('admin.Select City') }}</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" @selected( $admin->city_id == $city->id)>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('city_id')
                        <strong class="invalid-feedback">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="address"><i class="fa-solid fa-map-marker-alt"></i> {{ __('admin.Address') }}</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ $admin->address }}">
                    @error('address')
                        <strong class="invalid-feedback">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group mt-2">
            <label for="timezone"><i class="fa-solid fa-clock"></i> {{ __('admin.Timezone') }}</label>
            <select class="form-control @error('timezone') is-invalid @enderror" id="timezone" name="timezone">
                @foreach(timezone_identifiers_list() as $tz)
                    <option value="{{ $tz }}" @selected($admin->timezone == $tz)>
                        {{ $tz }}
                    </option>
                @endforeach
            </select>
            @error('timezone')
                <strong class="invalid-feedback">{{ $message }}</strong>
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
                <strong class="invalid-feedback">{{ __('validation.The current password field is required.') }}</strong>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="new_password"><i class="fas fa-unlock-alt"></i> {{ __('admin.New Password') }}</label>
            <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password">
            @error('new_password')
                <strong class="invalid-feedback">{{ __('validation.The new password field is required.') }}</strong>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="new_password_confirmation"><i class="fas fa-clipboard-check"></i> {{ __('admin.Confirm Password') }}</label>
            <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="new_password_confirmation" name="new_password_confirmation">
            @error('new_password_confirmation')
                <strong class="invalid-feedback">{{ $message }}</strong>
            @enderror
        </div>
    </div>
  </div>

  <div class="my-4 ms-2">
      <button type="submit" class="btn btn-primary">{{ __('admin.Save Changes') }}</button>
  </div>

</form>

@endsection

@section('page-scripts')
<script src="{{ asset('assets/js/imagePreview.js') }}"></script>

@endsection
