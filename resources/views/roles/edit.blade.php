@extends('layouts.master')

@section('page-title')
    {{ __('admin.Edit Role') }}
@endsection

@section('page-content')
<div class="card">
    <div class="card-body">
        <h1 class="text-center bg-success text-white"><i class="fa-solid fa-pen-to-square"></i> {{ trans('admin.Edit Role') }}</h1>
        <form action="{{ route('roles.update',$role->id) }}" method="POST" class="row">
            @csrf
            @method('PUT')
            <div class="form-group col-md-12">
                <label for="name"><i class="fa-solid fa-file-signature"></i> {{ __('admin.Name') }}<span class="text-danger ms-2">*</span></label>
                <input type="text" name="name" id="name" value="{{ $role->name }}"
                    class="form-control @error('name') is-invalid @enderror">
            </div>

            <div class="form-group col-md-12">
                <label>{{ __('admin.Permissions') }}</label>
                <div class="row">
                    @foreach($permissions as $permission)
                    <div class="col-4">
                        <div class="form-check">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                                class="form-check-input" 
                                {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $permission->name }}</label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">{{ __('admin.Update') }}</button>
                <button type="reset" class="btn btn-secondary btn-lg">{{ __('admin.Reset') }}</button>
            </div>

        </form>
    </div>
</div>

@endsection


