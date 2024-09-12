@extends('layouts.master')

@section('page-title')
    {{ __('admin.All Super Skills') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
          <div class="card-body">
                <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Super Skills') }}</h1>
                <table class="table table-hover table-bordered" id="data-table">
                    <thead class="table-dark">
                        <tr>
                            <th>{{ __('admin.ID') }}</th>
                            <th>{{ __('admin.Name') }}</th>
                            <th>{{ __('admin.Course') }}</th>
                            <th>{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($super_skills as $super_skill)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $super_skill->name }}</td>
                                <td>{{ $super_skill->course->name }}</td>
                
                                <td>
                                    <a href="{{ route('super-skills.edit', $super_skill->id) }}"><i class="fa-solid fa-file-signature text-success"></i></a>
                                    <a href="#" class="btn-delete" data-url="{{ route('super-skills.destroy', $super_skill->id) }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form id="delete-form-{{ $super_skill->id }}" action="{{ route('super-skills.destroy', $super_skill->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h1 class="text-center">No Super Skills Found!</h1>
                        @endforelse
                    </tbody>
                </table>
        </div>
        </div>


    @endsection
