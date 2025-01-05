@extends('layouts.master')

@section('page-title')
    {{ __('admin.Courses') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
        <div class="card-body">
             <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Courses') }}</h1>
               <!-- Bulk Delete Form -->
               <form action="{{ route('courses.bulk-destroy') }}" method="post" style="margin-bottom: 20px;">
                 @csrf
                 @method('delete')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete the selected courses?');">
                    {{ __('admin.Delete Selected') }}
                  </button>
                <table class="table table-hover table-bordered" id="data-table">
                <thead class="table-dark">
                       <tr>
                            <th><input type="checkbox" id="check-all"></th>
                            <th>{{ __('admin.ID') }}</th>
                            <th>{{ __('admin.Name') }}</th>
                            <th>{{ __('admin.Price') }}</th>
                            <th>{{ __('admin.Hours') }}</th>
                            <th>{{ __('admin.Category') }}</th>
                            <th>{{ __('admin.Image') }}</th>
                            <th>{{ __('admin.Date') }}</th>
                            <th>{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{ $course->id }}"></td>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->price }}</td>
                                <td>{{ $course->hours }}</td>
                                <td>{{ $course?->category?->name ?? 'UnCategorized' }}</td>
                                <td>
                                    @if($course->image)
                                        <img src="{{ asset('storage/' . $course->image->path) }}" width="70px" class="mr-2">
                                    @endif
                                </td>
                                <td>{{\Carbon\Carbon::parse($course->created_at)->diffForHumans()}}</td>
                                <td>
                                    <a href="{{ route('courses.show', $course->id) }}"><i class="fa-solid fa-eye text-info"></i></a>
                                    <a href="{{ route('courses.edit', $course->id) }}"><i class="fa-solid fa-file-signature text-success"></i></a>
                                    <a href="#" class="btn-delete" data-url="{{ route('courses.destroy', $course->id) }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form action="{{ route('courses.destroy', $course->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
               </form>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="averagePriceModal" tabindex="-1" role="dialog" aria-labelledby="averagePriceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="averagePriceModalLabel">{{ __('admin.Average Price') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{ __('admin.The Average Price for Courses is') }} <strong>${{ round($averagePrice) }}</strong>.
        </div>
      </div>
    </div>
</div>

@endsection

@section('page-scripts')
<script src="{{ asset('assets/js/courses/course.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
@endsection
