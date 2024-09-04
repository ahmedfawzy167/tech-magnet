@extends('layouts.master')

@section('page-title')
   {{__('admin.All Payments')}}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
          <div class="card-body">
                <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{__('admin.All Payments')}}
                </h1>
                <table class="table table-hover table-bordered" id="data-table">
                    <thead class="table-dark">
                        <tr>
                            <th>{{ __('admin.User') }}</th>
                            <th>{{ __('admin.Course') }}</th>
                            <th>{{ __('admin.Amount') }}</th>
                            <th>{{ __('admin.Currency') }}</th>
                            <th>{{ __('admin.Created at') }}</th>
                            <th>{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                            <tr>
                                <td>{{ $payment->user->name }}</td>
                                <td>{{ $payment->course->name }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->currency }}</td>
                                <td>{{\Carbon\Carbon::parse($payment->created_at)->diffForHumans() }}</td>
                                <td>
                                    <form action="{{route('payments.update',$payment->id)}}" method="post" style="display: inline-block">
                                        @csrf
                                        @method('PUT')
                                          <button type="submit" class="btn btn-success" style="display: inline-block">{{__('admin.Accept')}}</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h1 class="text-center">No Payments Found!</h1>
                        @endforelse
                    </tbody>
                </table>
        </div>
        </div>

    @endsection
