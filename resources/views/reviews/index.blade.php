@extends('layouts.master')

@section('page-title')
    {{__('admin.Reviews')}}
@endsection

@section('page-content')
<div class="row">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{__('admin.All Reviews')}}
            </h1>
            <table class="table table-hover table-bordered" id="data-table">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">{{ __('admin.ID') }}</th>
                        <th class="text-center">{{ __('admin.User') }}</th>
                        <th class="text-center">{{ __('admin.Course') }}</th>
                        <th class="text-center">{{ __('admin.Content') }}</th>
                        <th class="text-center">{{ __('admin.Rating') }}</th>
                        <th class="text-center">{{ __('admin.Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $review->user->name }}</td>
                        <td class="text-center">{{ $review->course->name }}</td>
                        <td class="text-center">{{ $review->content }}</td>
                        <td class="text-center">{{ $review->rating }}</td>
                        <td class="text-center">
                            <a href="#" class="btn-delete" data-url="{{ route('reviews.destroy', $review->id) }}">
                                <i class="fa-solid fa-trash text-danger"></i>
                            </a>
                            <form action="{{ route('reviews.destroy', $review->id) }}" method="post"
                                style="display: none;">
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