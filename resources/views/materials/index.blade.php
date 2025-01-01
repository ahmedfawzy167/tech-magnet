@extends('layouts.master')

@section('page-title')
    {{ __('admin.Materials') }}
@endsection

@section('page-content')
<div class="row">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-list"></i> {{ __('admin.All Materials') }}</h1>
            
            <div class="row">
                @if(count($materials) > 0)
                    @foreach($materials as $material)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fa-solid fa-file-pdf fa-3x text-danger"></i>
                                    <h5 class="mt-3">{{ basename($material) }}</h5>

                                    <!-- Preview the PDF -->
                                    <a href="{{ asset('storage/' . $material) }}" target="_blank" class="btn btn-primary btn-sm mt-2">
                                        <i class="fa-solid fa-eye"></i> {{ __('Preview') }}
                                    </a>

                                    <!-- Download the PDF -->
                                    <a href="{{ asset('storage/' . $material) }}" download class="btn btn-success btn-sm mt-2">
                                        <i class="fa-solid fa-download"></i> {{ __('Download') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center bg-warning">{{ __('admin.No Materials Found') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection