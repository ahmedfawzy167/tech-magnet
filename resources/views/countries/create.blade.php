@extends('layouts.master')

@section('page-title')
    {{ __('admin.New Country') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center bg-primary text-white"><i class="ion-plus-circled"></i> {{__('admin.Add New Country')}}</h1>
            <form action="{{ route('countries.store') }}" method="POST" class="row">
                @csrf
                <div class="form-group col-12">
                    <label for="name"> {{ __('admin.Name') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror">
                </div>

                <div class="form-group col-6">
                    <label for="code"> {{ __('admin.Code') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="code" id="code" value="{{ old('code') }}"
                        class="form-control @error('code') is-invalid @enderror">
                </div>

                <div class="form-group col-6">
                    <label for="phone_code"> {{ __('admin.Phone Code') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="phone_code" id="phone_code" value="{{ old('phone_code') }}"
                    class="form-control @error('phone_code') is-invalid @enderror">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('admin.Add') }}</button>
                    <button type="reset" class="btn btn-secondary btn-lg">{{ __('admin.Reset') }}</button>
                </div>

            </form>
        </div>
    </div>

@endsection




    

 
