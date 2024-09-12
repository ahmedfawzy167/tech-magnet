@extends('layouts.master')

@section('page-title')
    {{ __('admin.Cities') }}
@endsection

@section('page-content')
    <div class="row">
      <div class="card">
        <div class="card-body">
            <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.Cities List') }}</h1>
                <table class="table table-hover table-bordered" id="data-table">
                    <thead class="table-dark">
                        <tr>
                            <th>{{ __('admin.ID') }}</th>
                            <th>{{ __('admin.Name') }}</th>
                            <th>{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cities as $city)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $city->name }}</td>
                                <td>
                                    <a href="{{ route('cities.show', $city->id) }}"><i class="fa-solid fa-eye text-info"></i></a>
                                    <a href="{{ route('cities.edit', $city->id) }}"><i class="fa-solid fa-file-signature text-success"></i></a>
                                    <a href="#" class="btn-delete" data-url="{{ route('cities.destroy', $city->id) }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form action="{{ route('cities.destroy', $city->id) }}" method="post" style="display: none;">
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
    </div>

@endsection
