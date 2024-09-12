@extends('layouts.master')

@section('page-title')
    {{ __('admin.Categories') }}
@endsection

@section('page-content')
    <div class="row">
      <div class="card">
        <div class="card-body">
           <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Categories') }}</h1>
              <table class="table table-hover table-bordered" id="data-table">
                <thead class="table-dark">
                     <tr>
                        <th>{{ __('admin.ID') }}</th>
                        <th>{{ __('admin.Name') }}</th>
                        <th>{{ __('admin.Actions') }}</th>
                     </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('categories.show', $category->id) }}"><i class="fa-solid fa-eye text-info"></i></a>
                                    <a href="{{ route('categories.edit', $category->id) }}"><i class="fa-solid fa-file-signature text-success"></i></a>
                                    <a href="#" class="btn-delete" data-url="{{ route('categories.destroy', $category->id) }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form  action="{{ route('categories.destroy', $category->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h1 class="text-center">No Categories Found!</h1>
                        @endforelse
                    </tbody>
                </table>
        </div>
      </div>



    @endsection
