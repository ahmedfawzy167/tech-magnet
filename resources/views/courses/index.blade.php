@extends('layouts.master')

@section('page-title')
    {{ __('admin.Courses') }}
@endsection

@section('page-content')
    <div class="row">
      <div class="card">
         <div class="card-body">
             <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Courses') }}</h1>
             <form id="bulk-action-form" method="POST">
              @csrf
              <input type="hidden" name="_method" id="bulk-method" value="">
             
              <table class="table table-hover table-bordered" id="data-table">
                  <thead class="table-dark">
                       <tr>
                            <th class="text-center"><input type="checkbox" id="check-all"></th>
                            <th class="text-center">{{ __('admin.ID') }}</th>
                            <th class="text-center">{{ __('admin.Name') }}</th>
                            <th class="text-center">{{ __('admin.Price') }}</th>
                            <th class="text-center">{{ __('admin.Hours') }}</th>
                            <th class="text-center">{{ __('admin.Category') }}</th>
                            <th class="text-center">{{ __('admin.Image') }}</th>
                            <th class="text-center">{{ __('admin.Date') }}</th>
                            <th class="text-center">{{ __('admin.Status') }}</th>
                            <th class="text-center">{{ __('admin.Actions') }}</th>
                       </tr>
                  </thead>
                  <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td class="text-center"><input type="checkbox" name="ids[]" value="{{ $course->id }}"></td>
                                <td class="text-center">{{ $loop->iteration}}</td>
                                <td class="text-center">{{ $course->name }}</td>
                                <td class="text-center">{{ $course->price }}</td>
                                <td class="text-center">{{ $course->hours }}</td>
                                <td class="text-center">{{ $course?->category?->name ?? 'UnCategorized' }}</td>
                                <td class="text-center">
                                  @if($course?->image)
                                      <img src="{{ asset('storage/courses/' . $course->id . '/' . $course->image->path) }}" width="70px" class="mr-2">
                                  @else
                                      <span class="badge bg-danger">{{ __('admin.No Image Available') }}</span>
                                  @endif
                                </td>
                                <td class="text-center">{{\Carbon\Carbon::parse($course->created_at)->diffForHumans()}}</td>
                                <td class="text-center">{!! $course->status->icon() !!}</td>
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
           
            <div class="mt-4">
              <!-- Bulk Activate -->
              <form action="{{ route('courses.bulk-activate') }}" method="POST" style="display: inline;">
                  @csrf
                  @method('PATCH')
                  <input type="hidden" name="ids[]" id="bulk-activate-ids">
                  <button type="submit" class="btn btn-success">
                      {{ __('admin.Activate Status') }}
                  </button>
              </form>

              <!-- Bulk Deactivate -->
              <form action="{{ route('courses.bulk-deactivate') }}" method="POST" style="display: inline;">
                  @csrf
                  @method('PATCH')
                  <input type="hidden" name="ids[]" id="bulk-deactivate-ids">
                  <button type="submit" class="btn btn-danger">
                      {{ __('admin.Deactivate Status') }}
                  </button>
              </form>

              <!-- Bulk Delete -->
              <form action="{{ route('courses.bulk-destroy') }}" method="POST" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <input type="hidden" name="ids[]" id="bulk-delete-ids">
                  <button type="submit" class="btn btn-warning">
                      {{ __('admin.Delete Selected') }}
                  </button>
              </form>
          </div>
         </div>
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
