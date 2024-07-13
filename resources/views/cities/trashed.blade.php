@extends('layouts.master')

@section('page-title')
    All Trashed Cities
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
        <div class="card-body">
             <h1 class="text-center bg-warning text-light"><i class="ion-alert"></i> All Trashed Cities</h1>
             <table class="table table-hover table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>{{ __('admin.ID') }}</th>
                        <th>{{ __('admin.Name') }}</th>
                        <th>{{ __('admin.Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($trashedCities as $city)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{ $city->name }}</td>
                                <td>
                                    <form action="{{ route('cities.restore', $city->id) }}" method="post" style="display: inline-block;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success"><i class="ion-loop"></i> Restore</button>
                                    </form>
                                
                                    <form action="{{ route('cities.force-delete', $city->id) }}" method="post" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="ion-trash-a"></i> Force Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <div>
                             <td colspan="3">
                               <h1 class="text-center alert alert-warning">No Trashed Cities Found!</h1>
                            </td>
                           </div>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
        </div>
    </div>

    @include('layouts.messages')


    @endsection
