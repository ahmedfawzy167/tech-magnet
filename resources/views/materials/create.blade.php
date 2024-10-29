@extends('layouts.master')

@section('page-title')
   {{__('New Material')}}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center bg-primary text-white"><i class="ion-plus-circled"></i>    {{__('New Material')}}</h1>
            <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data" class="row">
                @csrf

                <div class="form-group col-md-12">
                    <label for="file">File <span class="text-danger ms-2">*</span></label>
                    <input type="file" name="file" id="file"
                        class="form-control @error('file') is-invalid @enderror">
                        <div class="invalid-feedback">
                            Please Upload a File
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
    

