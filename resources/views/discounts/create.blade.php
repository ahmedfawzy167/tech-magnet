@extends('layouts.master')

@section('page-title')
    {{ __('admin.New Discount') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center bg-primary text-white"><i class="ion-plus-circled"></i> {{__('admin.Add New Discount')}}</h1>
            <form action="{{ route('discounts.store') }}" method="POST" class="row">
                @csrf
                <div class="form-group col-12">
                    <label for="code"> {{ __('admin.Code') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="code" id="code" value="{{ old('code') }}"
                        class="form-control @error('code') is-invalid @enderror">
                </div>

                <div class="form-group col-6">
                    <label for="amount"> {{ __('admin.Amount') }}<span class="text-danger ms-2">*</span></label>
                    <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount') }}"
                    class="form-control @error('amount') is-invalid @enderror">
                </div>

                <div class="form-group col-6">
                    <label for="percentage"> {{ __('admin.Percentage') }}<span class="text-danger ms-2">*</span></label>
                    <input type="number" step="0.01" name="percentage" id="percentage" value="{{ old('percentage') }}"
                    class="form-control @error('percentage') is-invalid @enderror">
                </div>

                 <div class="form-group col-12">
                   <label for="expiry_date">{{__('admin.Expiry Date')}}<span class="text-danger ms-2">*</span></label>
                   <input type="date" name="expiry_date" value="{{ old('expiry_date') }}" id="expiry_date" class="form-control @error('expiry_date') is-invalid @enderror">
                 </div>

                 <div class="form-group col-12">
                     <label for="courses">{{__('admin.Courses')}}<span class="text-danger ms-2">*</span></label><br>
                      <select name="courses[]" id="courses" class="form-select" multiple>
                        <option value="#"selected>Choose..</option>
                        @foreach ($courses as $course)
                        <option value="{{$course->id}}">{{ $course->name }}</option>
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


    

 
