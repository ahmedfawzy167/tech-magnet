@extends('layouts.master')

@section('page-title')
  {{__('admin.New Setting')}}
@endsection

@section('page-content')

<div class="card">
   <div class="card-body">
    <h1 class="text-center bg-primary text-light"><i class="fa-solid fa-gear"></i> {{__('admin.Add New Setting')}}</h1>
    <form action="{{route('settings.store')}}" method="post" enctype="multipart/form-data" class="row">
     @csrf

    <div class="form-group col-12">
      <label for="logo">{{__('admin.Image')}}<span class="text-danger ms-2">*</span></label>
      <input type="file" name="logo" id="logo" class="form-control @error('image') is-invalid @enderror">
    </div>

    <div class="form-group col-12">
      <label for="email">{{__('admin.Email')}}<span class="text-danger ms-2">*</span></label>
      <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
    </div>

    <div class="form-group col-12">
      <label for="phone">{{__('admin.Phone')}}<span class="text-danger ms-2">*</span></label>
      <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror">
      </div>

    <div class="form-group col-12">
        <label for="location">{{__('admin.Location')}}<span class="text-danger ms-2">*</span></label>
        <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror">
    </div>

    {{-- <div id="map" style="height: 500px; width: 100%;"></div> --}}

      <div class="text-center mt-4">
          <button type="submit" class="btn btn-primary btn-lg">{{__('admin.Add')}}</button>
          <button type="reset" class="btn btn-secondary btn-lg">{{__('admin.Reset')}}</button>
      </div>
</form>
</div>
</div>

@endsection


@section('page-scripts')

  {{-- <!-- Google Maps API Script -->
  <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&region=EG&language={{ app()->getLocale() }}&callback=initMap" async defer></script>
  
  <script>
     function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: -34.397, lng: 150.644 },
                zoom: 8,
                mapTypeId: "terrain",
            });
        }
  </script> --}}
@endsection
