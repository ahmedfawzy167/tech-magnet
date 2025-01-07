@extends('layouts.master')

@section('page-title')
    {{ __('admin.Categories') }}
@endsection

@section('page-content')
    <div class="row">
      <div class="card">
        <div class="card-body">
           <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Categories') }}</h1>
           <!-- Button to Open the Modal -->
            <div class="mb-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoryModal" id="addCategoryBtn">
                  <i class="fa-solid fa-plus"></i> {{ __('admin.New Category') }}
                </button>
            </div>
              <table class="table table-hover table-bordered" id="data-table">
                <thead class="table-dark">
                     <tr>
                        <th class="text-center">{{ __('admin.ID') }}</th>
                        <th class="text-center">{{ __('admin.Name') }}</th>
                        <th class="text-center">{{ __('admin.Date') }}</th>
                        <th class="text-center">{{ __('admin.Actions') }}</th>
                     </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td class="text-center">{{ $loop->index + 1 }}</td>
                                <td class="text-center">{{ $category->name }}</td>
                                <td class="text-center">{{\Carbon\Carbon::parse($category->created_at)->diffForHumans()}}</td>
                                <td class="text-center">
                                    <a href="{{ route('categories.show', $category->id) }}"><i class="fa-solid fa-eye text-info"></i></a>
                                    <a href="#" class="btn-edit" data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-toggle="modal" data-target="#updateCategoryModal">
                                        <i class="fa-solid fa-file-signature text-success"></i>
                                    </a>
                                    <a href="#" class="btn-delete" data-url="{{ route('categories.destroy', $category->id) }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                    <form  action="{{ route('categories.destroy', $category->id) }}" method="post" style="display: none;">
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


<!-- Modal For Adding Category -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">{{ __('admin.New Category') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="categoryForm" method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="categoryName">{{ __('admin.Name') }}</label>
                        <input type="text" class="form-control" id="categoryName" name="name" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin.Close') }}</button>
                <button type="submit" form="categoryForm" class="btn btn-primary">{{ __('admin.Save') }}</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal for Updating a Category -->
<div class="modal fade" id="updateCategoryModal" tabindex="-1" aria-labelledby="updateCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateCategoryModalLabel">{{ __('admin.Edit Category') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateCategoryForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="updateCategoryId" name="id">
                    <div class="form-group">
                        <label for="updateCategoryName">{{ __('admin.Name') }}</label>
                        <input type="text" class="form-control" id="updateCategoryName" name="name" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin.Close') }}</button>
                <button type="submit" form="updateCategoryForm" class="btn btn-primary">{{ __('admin.Update') }}</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('page-scripts')
    <script src="{{ asset('assets/js/categories/categories.js') }}"></script>
@endsection
