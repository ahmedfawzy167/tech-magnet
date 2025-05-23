@extends('layouts.master')

@section('page-title')
    {{ __('admin.Addresses') }}
@endsection

@section('page-content')
<div class="row">
    <div class="card">
    <div class="card-body">
         <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Addresses') }}</h1>
         <table class="table table-hover table-bordered" id="data-table">
            <thead class="table-dark">
                   <tr>
                        <th class="text-center">{{ __('admin.ID') }}</th>
                        <th class="text-center">{{ __('admin.Location') }}</th>
                        <th class="text-center">{{ __('admin.User') }}</th>
                        <th class="text-center">{{ __('admin.City') }}</th>
                        <th class="text-center">{{ __('admin.Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($addresses as $address)
                        <tr>
                            <td class="text-center">{{ $loop->index+1 }}</td>
                            <td class="text-center">{{ $address->address }}</td>
                            <td class="text-center">{{ $address?->user?->name }}</td>
                            <td class="text-center">{{ $address?->city?->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('addresses.show', $address->id) }}"><i class="fa-solid fa-eye text-info"></i></a>
                                <a href="{{ route('addresses.edit', $address->id) }}"><i class="fa-solid fa-file-signature text-success"></i></a>
                                <a href="#" class="btn-delete" data-url="{{ route('addresses.destroy', $address->id) }}">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </a>
                                <form action="{{ route('addresses.destroy', $address->id) }}" method="post" style="display: none;">
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


