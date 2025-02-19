@extends('layouts.master')

@section('page-title')
    {{ __('admin.Countries') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
        <div class="card-body">
             <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Countries') }}</h1>
             <table class="table table-hover table-bordered" id="data-table">
                <thead class="table-dark">
                       <tr>
                            <th class="text-center">{{ __('admin.ID') }}</th>
                            <th class="text-center">{{ __('admin.Name') }}</th>
                            <th class="text-center">{{ __('admin.Code') }}</th>
                            <th class="text-center">{{ __('admin.Phone Code') }}</th>
                            <th class="text-center">{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($countries as $country)
                            <tr>
                                <td class="text-center">{{ $loop->index+1 }}</td>
                                <td class="text-center">{{ $country->name }}</td>
                                <td class="text-center">{{ $country->code }}</td>
                                <td class="text-center">{{ $country->phone_code }}</td>
                                <td class="text-center">
                                    <a href="{{ route('countries.show', $country->id) }}"><i class="fa-solid fa-eye text-info"></i></a>
                                    <a href="{{ route('countries.edit', $country->id) }}"><i class="fa-solid fa-file-signature text-success"></i></a>
                                    <a href="#" class="btn-delete" data-url="{{ route('countries.destroy', $country->id) }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form action="{{ route('countries.destroy', $country->id) }}" method="post" style="display: none;">
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

@endsection

