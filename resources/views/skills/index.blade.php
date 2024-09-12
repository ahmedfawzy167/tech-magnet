@extends('layouts.master')

@section('page-title')
    {{ __('admin.Skills') }}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
         <div class="card-body">
                <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Skills') }}</h1>
                <table class="table table-hover table-bordered" id="data-table">
                    <thead class="table-dark">
                        <tr>
                            <th>{{ __('admin.Title') }}</th>
                            <th>{{ __('admin.Super Skills') }}</th>
                            <th>{{ __('admin.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($skills as $skill)
                            <tr>
                                <td>{{ $skill->title }}</td>
                                @if (isset($skill->superSkill))
                                 <td>{{ $skill->superSkill->name }}</td>
                                @endif
                                <td>
                                    <a href="{{ route('skills.edit', $skill->id) }}"><i class="fa-solid fa-file-signature text-success"></i></a>
                                    <a href="#" class="btn-delete" data-url="{{ route('skills.destroy', $skill->id) }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form action="{{ route('skills.destroy', $skill->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h1 class="text-center">No Skills Found!</h1>
                        @endforelse
                    </tbody>
                </table>
        </div>
        </div>


    @endsection
