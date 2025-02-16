@extends('layouts.master')

@section('page-title')
    {{ __('admin.New Banner') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center bg-primary text-white"><i class="ion-plus-circled"></i> {{ __('admin.Add New Banner') }}</h1>
            <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data" class="row">
                @csrf
                <div class="form-group col-md-12">
                    <label for="name"> {{ __('admin.Name') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror">
                </div>

                <div class="form-group col-md-12">
                    <label for="image"> {{ __('admin.Image') }} <span class="text-muted">{{ (__('admin.(Optional)'))}}</span></label>
                    <input type="file" name="images" id="image"
                        class="form-control @error('images') is-invalid @enderror" onchange="previewImage(event)">
                    <img id="imagePreview" class="mt-3" src="#" alt="Image Preview" style="display:none; max-width: 300px; height: auto;">
                </div>

               <div class="form-group col-12 mt-3">
                <label for="locations">{{__('admin.Locations')}}<span class="text-danger ms-2">*</span></label>
                <select name="locations[]" id="locations" multiple class="form-select @error('locations') is-invalid @enderror">
                    @foreach($locations as $location)
                      <option value="{{$location->id}}">{{$location->name}}</option>
                    @endforeach
                 </select>
               </div>
               
        
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('admin.Add') }}</button>
                    <button type="reset" class="btn btn-secondary btn-lg">{{ __('admin.Reset') }}</button>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('page-scripts')
<script src="{{ asset('assets/js/imagePreview.js') }}"></script>
@endsection
    

 
