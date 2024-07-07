@extends('layouts.master')

@section('page-title')
  {{__('admin.All Materials')}}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
         <div class="card-body">
            <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{__('admin.All Materials')}}</h1>
            <table class="table table-hover table-bordered" id="data-table">
                    <thead class="table-dark">
                        <tr>
                            <th>{{ __('admin.ID') }}</th>
                            <th>{{ __('admin.Title') }}</th>
                            <th>{{__('admin.Description')}}</th>
                            <th>{{__('admin.File Type')}}</th>
                            <th>{{ __('admin.Course') }}</th>
                            <th>{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($materials as $material)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $material->title }}</td>
                                <td>{{\Str::limit($material->description,30) }}</td>
                                <td>{{ $material->file_type }}</td>
                                <td>{{ $material->course->name }}</td>
                                <td>
                                    <a href="{{route('materials.show',$material->id)}}">
                                        <i class="fa-solid fa-eye text-info"></i>
                                    </a>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $material->id }}').submit();">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form id="delete-form-{{ $material->id }}" action="{{ route('materials.destroy', $material->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h1 class="text-center">No Materials Found!</h1>
                        @endforelse
                    </tbody>
                </table>
        </div>

        @include('layouts.messages')


    @endsection
