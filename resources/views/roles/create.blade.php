@extends('layouts.master')

@section('page-title')
    {{ __('admin.New Role') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center bg-primary text-white"><i class="ion-plus-circled"></i> {{trans('admin.New Role')}}</h1>
            <form action="{{ route('roles.store') }}" method="POST" class="row">
                @csrf
                <div class="form-group col-md-12">
                    <label for="name"> {{ __('admin.Name') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror">
                </div>

                <div class="form-group col-md-12">
                    <label>{{ __('admin.Permissions') }}</label>
                    <div class="row">
                        @foreach($permissions as $permission)
                        <div class="col-4">
                            <div class="form-check">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                                    class="form-check-input">
                                <label class="form-check-label">{{ $permission->name }}</label>
                            </div>
                        </div>
                        @endforeach
                        </div>
                    </div>
                </div>
                    
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('admin.Add') }}</button>
                    <button type="reset" class="btn btn-secondary btn-lg">{{ __('admin.Reset') }}</button>
                </div>
            </form>
        </div>
    </div>

    @endsection


