@extends('layouts.master')

@section('page-title')
    {{ __('admin.Edit Category') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center text-light bg-success"><i class="fa-solid fa-pen-to-square"></i> {{trans('admin.Edit Category')}}</h1>
            <form action="{{ route('categories.update',$category->id) }}" method="POST" class="row">
                @csrf
                @method('PUT')
                <div class="form-group col-md-12">
                    <label for="name">{{ __('admin.Name') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="name" id="name" value="{{$category->name}}"
                        class="form-control @error('name') is-invalid @enderror">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('admin.Update') }}</button>
                    <button type="reset" class="btn btn-secondary btn-lg">{{ __('admin.Reset') }}</button>
                </div>

            </form>
        </div>
    </div>
    @endsection


   
