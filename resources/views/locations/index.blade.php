@extends('layouts.master')

@section('page-title')
    {{ __('admin.Locations') }}
@endsection

@section('page-content')
    <div class="row">
      <div class="card">
        <div class="card-body">
           <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Locations') }}</h1>
           <!-- Button to Open the Modal -->
            <div class="mb-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#locationModal" id="addLocationBtn">
                  <i class="fa-solid fa-plus"></i> {{ __('admin.New Location') }}
                </button>
            </div>
              <table class="table table-hover table-bordered" id="data-table">
                <thead class="table-dark">
                     <tr>
                        <th class="text-center">{{ __('admin.ID') }}</th>
                        <th class="text-center">{{ __('admin.Name') }}</th>
                        <th class="text-center">{{ __('admin.Actions') }}</th>
                     </tr>
                    </thead>
                    <tbody>
                        @foreach($locations as $location)
                            <tr>
                                <td class="text-center">{{ $loop->index + 1 }}</td>
                                <td class="text-center">{{ $location->name }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn-edit" data-id="{{ $location->id }}" data-name="{{ $location->name }}" data-toggle="modal" data-target="#updateLocationModal">
                                        <i class="fa-solid fa-file-signature text-success"></i>
                                    </a>
                                    <a href="#" class="btn-delete" data-url="{{ route('locations.destroy', $location->id) }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form  action="{{ route('locations.destroy', $location->id) }}" method="post" style="display: none;">
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


<!-- Modal For Adding Location -->
<div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="locationModalLabel">{{ __('admin.New Location') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="locationForm" method="POST" action="{{ route('locations.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="locationName">{{ __('admin.Name') }}</label>
                        <input type="text" class="form-control" id="locationName" name="name" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin.Close') }}</button>
                <button type="submit" form="locationForm" class="btn btn-primary">{{ __('admin.Save') }}</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal for Updating a Location -->
<div class="modal fade" id="updateLocationModal" tabindex="-1" aria-labelledby="updateLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateLocationModalLabel">{{ __('admin.Edit Location') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateLocationForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="updateLocationId" name="id">
                    <div class="form-group">
                        <label for="updateLocationName">{{ __('admin.Name') }}</label>
                        <input type="text" class="form-control" id="updateLocationName" name="name" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin.Close') }}</button>
                <button type="submit" form="updateLocationForm" class="btn btn-primary">{{ __('admin.Update') }}</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('page-scripts')
    <script src="{{ asset('assets/js/locations/locations.js') }}"></script>
@endsection
