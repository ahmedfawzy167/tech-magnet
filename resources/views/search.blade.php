@extends('layouts.master')

@section('page-title')
    {{ __('admin.Search') }}
@endsection

@section('page-content')

    <div class="d-flex justify-content-center align-items-center vh-60">
        <div class="card" style="width: 60rem;">
            <div class="card-body">
                <h2 class="card-title text-center bg-success">
                    <i class="fa-solid fa-eye"></i> {{ $searchResults->count() }} {{ __('admin.Results') }}
                </h2>
            </div>
            <ul class="list-group list-group-flush">
                @foreach($searchResults as $result)
                    @if($result->searchable instanceof \App\Models\Course)
                        <li class="list-group-item">{{ $result->searchable->name }}</li>
                        <li class="list-group-item">{{ $result->searchable->price }}</li>
                        <li class="list-group-item">{{ $result->searchable->hours }}</li>
                        <li class="list-group-item">{{ $result->searchable->category->name }}</li>
                        <li class="list-group-item">{{ $result->searchable->objective->name }}</li>
                    @else
                    <li class="list-group-item">
                        {{__('admin.No Results Found!')}}
                    </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

@endsection
