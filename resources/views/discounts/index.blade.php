@extends('layouts.master')

@section('page-title')
    {{ __('admin.Discounts') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
        <div class="card-body">
             <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Discounts') }}</h1>
             <table class="table table-hover table-bordered" id="data-table">
                <thead class="table-dark">
                       <tr>
                            <th class="text-center">{{ __('admin.ID') }}</th>
                            <th class="text-center">{{ __('admin.Code') }}</th>
                            <th class="text-center">{{ __('admin.Amount') }}</th>
                            <th class="text-center">{{ __('admin.Percentage') }}</th>
                            <th class="text-center">{{ __('admin.Expiry Date') }}</th>
                            <th class="text-center">{{ __('admin.Courses') }}</th>
                            <th class="text-center">{{ __('admin.Status') }}</th>
                            <th>{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($discounts as $discount)
                            <tr>
                                <td class="text-center">{{ $loop->index+1 }}</td>
                                <td class="text-center">{{ $discount->code }}</td>
                                <td class="text-center">{{ $discount->amount }}</td>
                                <td class="text-center">{{ $discount->percentage }}</td>
                                <td class="text-center">{{ $discount->expiry_date }}</td>
                                <td class="text-center" data-bs-toggle="tooltip" data-bs-html="true" title="{{ implode(', ', $discount->courses->pluck('name')->toArray()) }}">
                                    {{ $discount->courses->count() }}
                                </td>
                                <td>
                                    @php
                                      $isExpired = $discount->expiry_date < now();
                                      $isAvailable = !$isExpired && $discount->is_active;
                                    @endphp
                                     <span class="badge {{ $isAvailable ? 'bg-success' : 'bg-danger' }}">
                                        {{ $isAvailable ? 'Available' : 'Unavailable' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('discounts.edit', $discount->id) }}"><i class="fa-solid fa-file-signature text-success"></i></a>
                                    <a href="#" class="btn-delete" data-url="{{ route('discounts.destroy', $discount->id) }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form action="{{ route('discounts.destroy', $discount->id) }}" method="post" style="display: none;">
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

@section('page-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>

@endsection
