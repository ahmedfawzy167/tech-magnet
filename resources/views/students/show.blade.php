@extends('layouts.master')

@section('page-title')
   {{__('admin.Show Student')}}
@endsection

@section('page-content')

<div class="d-flex justify-content-center align-items-center vh-60">
    <div class="card" style="width: 60rem;">
      <div class="card-body">
        <h2 class="card-title text-center bg-info text-white"><i class="fa-solid fa-eye"></i> {{__('admin.Student Details')}}</h2>
      </div>
      <ul class="list-group list-group-flush">
        <h4 class="list-group-item">{{__('admin.Name')}}: {{$student->name}}</h4>
        <h4 class="list-group-item">{{__('admin.Email')}}: {{$student->email}}</h4>
        <h4 class="list-group-item">{{__('admin.Phone')}}: {{$student->phone}}</h4>
        <h4 class="list-group-item">{{ __('admin.Role') }}: 
          @if ($student->roles->isNotEmpty())
            {{ $student->roles->pluck('name')->implode(', ') }} 
          @endif
        </h4>
        <h4 class="list-group-item">{{__('admin.Addresses')}}:
          @if ($student->addresses->isEmpty())
            <li class="badge bg-danger" >{{ __('admin.No Address Defined!') }}</li>
          @else
            @foreach ($student->addresses as $address)
              <li class="ms-4">{{ $address?->address }}</li>
             @endforeach
          @endif
        </h4>
     </ul>
    </div>
  </div>
  <div class="text-center">
     <a href="{{route('students.index')}}" class="btn btn-info mt-2">{{__('admin.Back to List')}}</a>
  </div>

@endsection
