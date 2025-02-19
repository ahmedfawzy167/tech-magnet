@extends('layouts.master')

@section('page-title')
    {{ __('admin.Cities') }}
@endsection

@section('page-content')
    <div class="row">
      <div class="card">
        <div class="card-body">
            <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.Cities List') }}</h1>
             <!-- Button to Open the Modal -->
             <div class="mb-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cityModal" id="addCityBtn">
                  <i class="fa-solid fa-plus"></i> {{ __('admin.New City') }}
                </button>
            </div>
                <table class="table table-hover table-bordered" id="data-table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">{{ __('admin.ID') }}</th>
                            <th class="text-center">{{ __('admin.Name') }}</th>
                            <th class="text-center">{{ __('admin.Countries') }}</th>
                            <th class="text-center">{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cities as $city)
                            <tr>
                                <td class="text-center">{{ $loop->index+1 }}</td>
                                <td class="text-center">{{ $city->name }}</td>
                                <td class="text-center">{{ $city?->country?->name}}</td>
                                <td class="text-center">
                                    <a href="{{ route('cities.show', $city->id) }}"><i class="fa-solid fa-eye text-info"></i></a>
                                    <a href="#" class="btn-edit" 
                                    data-id="{{ $city->id }}"  
                                    data-name="{{ $city->name }}" 
                                    data-country-id="{{ $city->country?->id }}" 
                                    data-toggle="modal" data-target="#updateCityModal">
                                    <i class="fa-solid fa-file-signature text-success"></i>
                                </a>
                                    <a href="#" class="btn-delete" data-url="{{ route('cities.destroy', $city->id) }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form action="{{ route('cities.destroy', $city->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            
        </div>
    </div>
    </div>


    
<!-- Modal For Adding City -->
<div class="modal fade" id="cityModal" tabindex="-1" aria-labelledby="cityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cityModalLabel">{{ __('admin.New City') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="cityForm" method="POST" action="{{ route('cities.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="cityName">{{ __('admin.Name') }}</label>
                        <input type="text" class="form-control" id="cityName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="countryId">{{ __('admin.Select Country') }}</label>
                        <select class="form-control" id="countryId" name="country_id" required>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin.Close') }}</button>
                <button type="submit" form="cityForm" class="btn btn-primary">{{ __('admin.Save') }}</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal for Updating a City -->
<div class="modal fade" id="updateCityModal" tabindex="-1" aria-labelledby="updateCityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateCityModalLabel">{{ __('admin.Edit City') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateCityForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="updateCityId" name="id">
                    <div class="form-group">
                        <label for="updateCityName">{{ __('admin.Name') }}</label>
                        <input type="text" class="form-control" id="updateCityName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="updateCountryId">{{ __('admin.Select Country') }}</label>
                        <select class="form-control" id="updateCountryId" name="country_id" required>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin.Close') }}</button>
                <button type="submit" form="updateCityForm" class="btn btn-primary">{{ __('admin.Update') }}</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-scripts')

<script src="{{ asset('assets/js/cities/cities.js') }}"></script>
    
@endsection
