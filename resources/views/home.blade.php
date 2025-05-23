@extends('layouts.master')

@section('page-title')
    {{ __('admin.Home Page') }}
@endsection

@section('page-head')

<link rel="stylesheet" href="{{ asset('assets/css/home/home.css') }}">

@endsection

@section('page-content')

    <body id="page-top">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">{{ __('admin.Dashboard') }}</h1>
            </div>

            <!-- Content Row -->
            <div class="row">

                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ route('courses.index') }}" class="text-decoration-none">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            {{ __('admin.Courses') }}
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$courses}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="ion-ios-folder fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                

                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ route('categories.index') }}" class="text-decoration-none">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            {{ __('admin.Categories') }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$categories}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="ion-android-menu fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                

                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ route('reviews.index') }}" class="text-decoration-none">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            {{ __('admin.Reviews') }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$reviews}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-thumbs-up fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ route('enrollments.index') }}" class="text-decoration-none">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                            {{ __('admin.Enrollments') }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$enrollments}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-user-plus fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ route('sessions.index') }}" class="text-decoration-none">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {{ __('admin.Sessions') }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$sessions}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user-check fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ route('bundles.index') }}" class="text-decoration-none">
                        <div class="card border-left-dark shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                            {{ __('admin.Bundles') }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$bundles}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-box fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ route('students.index') }}" class="text-decoration-none">
                        <div class="card border-left-secondary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                            {{ __('admin.Students') }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$students}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ route('cities.index') }}" class="text-decoration-none">
                        <div class="card border-left-pink shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-pink text-uppercase mb-1">
                                            {{ __('admin.Cities') }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cities}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-city fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                

            </div>

            <!-- Content Row -->
            <div class="row">
                <div class="col-xl-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                          <h4><i class="fa-solid fa-chart-simple"></i> {{ __('admin.Courses Chart') }}</h4>
                        </div>
                        
                        <div class="card-body" style="width: 800px; height: 800px; margin: auto;">
                            {!! $chart1->renderHtml() !!}
                        </div>
                    </div>
                </div>

        
                <div class="col-xl-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <span class="card-title fs-3"><i class="fa-regular fa-calendar-days"></i>
                                {{ __('admin.Courses For June Month') }}</span>

                            <span class="card-title float-right fs-5 mt-2">
                               {{__('admin.Explore More Diplomas')}} <a href="{{route('courses.index')}}"><i class="ion-arrow-right-a text-dark"></i></a></span>
                        </div>
                        
                        <table class="table table-hover table-bordered" id="data-table">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">{{ __('admin.ID') }}</th>
                                    <th class="text-center">{{ __('admin.Name') }}</th>
                                    <th class="text-center">{{ __('admin.Category') }}</th>
                                    <th class="text-center">{{ __('admin.Price') }}</th>
                                    <th class="text-center">{{ __('admin.Hours') }}</th>
                                    <th class="text-center">{{ __('admin.Date') }}</th>
                                    <th class="text-center">{{ __('admin.Image') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($juneCourses as $course)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $course->name }}</td>
                                        <td class="text-center">{{ $course->category->name }}</td>
                                        <td class="text-center">EGP {{ $course->price }}</td>
                                        <td class="text-center">{{ $course->hours }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($course->created_at)->diffForHumans() }}</td>
                                        <td class="text-center">
                                             @if($course->image)
                                                 <img src="{{ getPath('courses', $course->id, $course->image->path) }}" width="70px" class="mr-2">
                                             @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
@endsection

@section('page-scripts')
{!! $chart1->renderChartJsLibrary() !!}
{!! $chart1->renderJs() !!}
@endsection

