@extends('layouts.master')

@section('page-title')
   {{__('admin.All Reviews')}}
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
                            <th>{{ __('admin.ID') }}</th>
                            <th>{{ __('admin.User') }}</th>
                            <th>{{ __('admin.Course') }}</th>
                            <th>{{ __('admin.Content') }}</th>
                            <th>{{ __('admin.Rating') }}</th>
                            <th>{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $review)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $review->user->name }}</td>
                                <td>{{ $review->course->name }}</td>
                                <td>{{ $review->content }}</td>
                                <td>{{ $review->rating }}</td>
                                <td>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $review->id }}').submit();">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form id="delete-form-{{ $review->id }}" action="{{ route('reviews.destroy', $review->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h1 class="text-center">No Reviews Found!</h1>
                        @endforelse
                    </tbody>
                </table>
        </div>
        </div>
        @include('layouts.messages')


    @endsection
