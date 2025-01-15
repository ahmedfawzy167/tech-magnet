@extends('layouts.master')

@section('page-title')
    {{ __('admin.All Sessions') }}
@endsection

@section('page-content')
    <div class="row">
      <div class="card">
         <div class="card-body">
             <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Sessions') }}</h1>     
              <table class="table table-hover table-bordered" id="data-table">
                  <thead class="table-dark">
                       <tr>
                            <th class="text-center">{{ __('admin.ID') }}</th>
                            <th class="text-center">{{ __('admin.Topic') }}</th>
                            <th class="text-center">{{ __('admin.Description') }}</th>
                            <th class="text-center">{{ __('admin.Created') }}</th>
                            <th class="text-center">{{ __('admin.Course') }}</th>
                            <th class="text-center">{{ __('admin.User') }}</th>
                            <th class="text-center">{{ __('admin.Meeting ID') }}</th>
                            <th class="text-center">{{ __('admin.Start Url') }}</th>
                            <th class="text-center">{{ __('admin.Join Url') }}</th>
                            <th class="text-center">{{ __('admin.Actions') }}</th>
                       </tr>
                  </thead>
                  <tbody>
                        @foreach($sessions as $session)
                            <tr>
                                <td class="text-center">{{ $loop->iteration}}</td>
                                <td class="text-center">{{ $session->topic }}</td>
                                <td class="text-center">{{ $session->description }}</td>
                                <td class="text-center">{{\Carbon\Carbon::parse($session->start_date)->diffForHumans()}}</td>
                                <td class="text-center">{{ $session->course->name }}</td>
                                <td class="text-center">{{ $session->user->name }}</td>
                                <td class="text-center"><span class="badge badge-danger" >{{ $session->meeting_id }}</span></td>
                                <td class="text-center">
                                    <a href="{{ $session->start_url }}" class="btn btn-primary" title="{{ __('admin.Start Session') }}">
                                        <i class="fa-solid fa-play"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ $session->join_url }}" class="btn btn-success" title="{{ __('admin.Join Session') }}">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn-delete" data-url="{{ route('sessions.destroy', $session->id) }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form action="{{ route('sessions.destroy', $session->id) }}" method="post" style="display: none;">
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


