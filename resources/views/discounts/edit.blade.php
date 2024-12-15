@extends('layouts.master')

@section('page-title')
    {{ __('admin.Edit Discount') }}
@endsection

@section('page-content')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center text-light bg-success"><i class="fa-solid fa-pen-to-square"></i> {{__('admin.Edit Discount')}}</h1></h1>
            <form action="{{ route('discounts.update',$discount->id) }}" method="POST" class="row">
                @csrf
                @method('PUT')
                <div class="form-group col-12">
                    <label for="code"> {{ __('admin.Code') }}<span class="text-danger ms-2">*</span></label>
                    <input type="text" name="code" id="code" value="{{ $discount->code ?? old('code') }}"
                        class="form-control @error('code') is-invalid @enderror">
                </div>

                <div class="form-group col-6">
                    <label for="amount"> {{ __('admin.Amount') }}<span class="text-danger ms-2">*</span></label>
                    <input type="number" step="0.01" name="amount" id="amount" value="{{ $discount->amount ?? old('amount') }}"
                    class="form-control @error('amount') is-invalid @enderror">
                </div>

                <div class="form-group col-6">
                    <label for="percentage"> {{ __('admin.Percentage') }}<span class="text-danger ms-2">*</span></label>
                    <input type="number" step="0.01" name="percentage" id="percentage" value="{{ $discount->percentage ?? old('percentage') }}"
                    class="form-control @error('percentage') is-invalid @enderror">
                </div>

                 <div class="form-group col-12">
                   <label for="expiry_date">{{__('admin.Expiry Date')}}<span class="text-danger ms-2">*</span></label>
                   <input type="date" name="expiry_date" id="expiry_date" value="{{ $discount->expiry_date ?? old('expiry_date') }}"class="form-control @error('expiry_date') is-invalid @enderror">
                 </div>

                 <div class="form-group col-12">
                    <label for="courses">{{__('admin.Courses')}}<span class="text-danger ms-2">*</span></label><br>
                     <select name="courses[]" id="courses" class="form-select select2" multiple>
                        @foreach ($courses as $course )  
                         <option value="{{ $course->id }}" 
                            {{ $discount->courses->contains($course->id) ? 'selected' : '' }}>
                            {{ $course->name }}
                         </option>
                        @endforeach

                     </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">{{ __('admin.Save Changes') }}</button>
                    <button type="reset" class="btn btn-secondary btn-lg">{{ __('admin.Reset') }}</button>
                </div>

            </form>
        </div>
    </div>
    @endsection


    

 
