@extends('layouts.master')

@section('page-title')
 Enrollments
@endsection

@include('layouts.messages')

@section('page-content')
    <div class="row">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
                <h1 class="text-center bg-primary text-light"><i class="fa-solid fa-list"></i> All Pending Enrollments</h1>
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>{{__('admin.ID')}}</th>
                            <th>{{__('admin.User')}}</th>
                            <th>{{__('admin.Course')}}</th>
                            <th>{{__('admin.Status')}}</th>
                            <th>{{__('admin.Date')}}</th>
                            <th>{{__('admin.Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enrollments as $enrollment)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$enrollment->user->name}}</td>
                            <td>{{$enrollment->course->name}}</td>

                            <td>{{$enrollment->status}}</td>
                            <td>{{\Carbon\Carbon::parse($enrollment->date)->diffForHumans()}}</td>
                            <td>
                                <form action="{{route('enrollments.update',$enrollment->id)}}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('PUT')
                                      <button type="submit" class="btn btn-outline-success" style="display: inline-block">Update Status</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

@include('layouts.messages')

@endsection