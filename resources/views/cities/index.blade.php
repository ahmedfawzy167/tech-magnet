@extends('layouts.master')

@section('page-title')
    {{ __('admin.All Cities') }}
@endsection


@section('page-content')
    <div class="row">
        <div class="card-body">

            <div class="table-responsive">
                <h1 class="text-center bg-primary text-light"><i class="fa-solid fa-list"></i> {{ __('admin.Cities List') }}
                </h1>
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
                                <td>{{ $city->id }}</td>
                                <td>{{ $city->name }}</td>
                                <td>
                                    <a href="{{ route('cities.show', $city->id) }}"
                                        class="btn btn-outline-secondary">{{ __('admin.Show') }}</a>
                                    <a href="{{ route('cities.edit', $city->id) }}"
                                        class="btn btn-outline-success">{{ __('admin.Edit') }}</a>
                                    <form action="{{ route('cities.destroy', $city->id) }}" method="post"
                                        style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger"
                                            style="display: inline-block">{{ __('admin.Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('layouts.messages')
@endsection
