@extends('layouts.master')

@section('page-title')
    {{ __('admin.Edit Banner') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center bg-primary text-white"><i class="ion-plus-circled"></i> {{ __('admin.Edit Banner') }}</h1>
            <form action="{{ route('banners.update',$banner->id) }}" method="POST" enctype="multipart/form-data" class="row">
                @csrf
                @method('PUT')
                <div class="form-group col-md-12">
                    <label for="name"> {{ __('admin.Name') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="name" id="name" value="{{$banner->name}}" class="form-control @error('name') is-invalid @enderror">
                </div>

                <div class="form-group col-md-12">
                    <label for="image"> {{ __('admin.Image') }} <span class="text-muted">{{ (__('admin.(Optional)'))}}</span></label>
                    <input type="file" name="images" id="image" class="form-control @error('images') is-invalid @enderror" onchange="previewImage(event)">
                    @if($banner?->image && $banner?->image?->path)
                        <img id="imagePreview"  src="{{ getPath('banners', $banner->id, $banner->image->path) }}" width="70px" class="mr-2">                       
                        @else
                         <div class="mt-2 text-danger d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <p class="mb-0">{{ __('admin.No Image Available') }}</p>
                         </div>
                      @endif
                </div>

               <div class="form-group col-12 mt-3">
                <label for="locations">{{__('admin.Locations')}}<span class="text-danger ms-2">*</span></label>
                <select name="locations[]" id="locations" multiple class="form-select @error('locations') is-invalid @enderror">
                    @foreach($locations as $location)
                      <option value="{{$location->id}}" {{ $banner->locations->contains($location->id) ? 'selected' : '' }} >{{$location->name}}</option>
                    @endforeach
                 </select>
               </div>
               
        
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('admin.Update') }}</button>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('page-scripts')
<script src="{{ asset('assets/js/imagePreview.js') }}"></script>
@endsection
    

 
