<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
            <div class="sidebar-brand-icon">
                <img src="{{ asset('storage/'.settings()->logo) }}" width="30px">
            </div>

              <div class="sidebar-brand-text mx-3">
                {{__('admin.Hello')}} @name
              </div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item @if(Route::currentRouteName() == 'home') active @endif">
            <a class="nav-link" href="{{route('home')}}">
                <span>{{__('admin.Dashboard')}}</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#hotelsCollapse"
                aria-expanded="true" aria-controls="hotelsCollapse">
                <span>{{__('admin.Courses')}}</span>
            </a>
            <div id="hotelsCollapse" class="collapse" aria-labelledby="headingHotels" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ isActiveRoute('courses.index', 'bg-primary text-white') }}" href="{{ route('courses.index') }}">
                        <i class="fa-solid fa-list"></i> {{ __('admin.All Courses') }}
                    </a>
                    <a class="collapse-item {{ isActiveRoute('courses.create', 'bg-primary text-white') }}" href="{{ route('courses.create') }}">
                        <i class="ion-plus-circled"></i> {{ __('admin.Add New Course') }}
                    </a>
                    <a class="collapse-item {{ isActiveRoute('courses.trashed', 'bg-primary text-white') }}" href="{{ route('courses.trashed') }}">
                        <i class="ion-alert"></i> {{ __('admin.All Trashed Courses') }}
                    </a>
                </div>
            </div>
        </li>

         <!-- Nav Item - Pages Collapse Menu -->
         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <span>{{__('admin.Categories')}}</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ isActiveRoute('categories.index', 'bg-primary text-white') }}" href="{{ route('categories.index') }}">
                        <i class="fa-solid fa-list"></i> {{ __('admin.All Categories') }}
                    </a>
                    <a class="collapse-item {{ isActiveRoute('categories.trashed', 'bg-primary text-white') }}" href="{{ route('categories.trashed') }}">
                        <i class="ion-alert"></i> {{ __('admin.All Trashed Categories') }}
                    </a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bannersCollapse"
                aria-expanded="true" aria-controls="bannersCollapse">
                <span>{{__('admin.Banners')}}</span>
            </a>
            <div id="bannersCollapse" class="collapse" aria-labelledby="headingBanners" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ isActiveRoute('banners.index', 'bg-primary text-white') }}" href="{{ route('banners.index') }}">
                        <i class="fa-solid fa-list"></i> {{ __('admin.All Banners') }}
                    </a>
                    <a class="collapse-item {{ isActiveRoute('banners.create', 'bg-primary text-white') }}" href="{{ route('banners.create') }}">
                        <i class="ion-plus-circled"></i> {{ __('admin.Add New Banner') }}
                    </a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#locationsCollapse"
                aria-expanded="true" aria-controls="locationsCollapse">
                <span>{{__('admin.Locations')}}</span>
            </a>
            <div id="locationsCollapse" class="collapse" aria-labelledby="headingLocations" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ isActiveRoute('locations.index', 'bg-primary text-white') }}" href="{{ route('locations.index') }}">
                        <i class="fa-solid fa-list"></i> {{ __('admin.All Locations') }}
                    </a>
                    <a class="collapse-item {{ isActiveRoute('locations.create', 'bg-primary text-white') }}" href="{{ route('locations.create') }}">
                        <i class="ion-plus-circled"></i> {{ __('admin.Add New Location') }}
                    </a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#usersCollapse"
                aria-expanded="true" aria-controls="usersCollapse">
                <span>{{__('admin.Students')}}</span>
            </a>
            <div id="usersCollapse" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ isActiveRoute('students.index', 'bg-primary text-white') }}" href="{{ route('students.index') }}">
                        <i class="fa-solid fa-list"></i> {{ __('admin.All Students') }}
                    </a>
                    <a class="collapse-item {{ isActiveRoute('students.create', 'bg-primary text-white') }}" href="{{ route('students.create') }}">
                        <i class="ion-plus-circled"></i> {{ __('admin.Add New Student') }}
                    </a>
                </div>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#instructorsCollapse"
                aria-expanded="true" aria-controls="instructorsCollapse">
                <span>{{__('admin.Instructors')}}</span>
            </a>
            <div id="instructorsCollapse" class="collapse" aria-labelledby="headinginstructors" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ isActiveRoute('instructors.index', 'bg-primary text-white') }}" href="{{ route('instructors.index') }}">
                        <i class="fa-solid fa-list"></i> {{ __('admin.All Instructors') }}
                    </a>
                    <a class="collapse-item {{ isActiveRoute('instructors.create', 'bg-primary text-white') }}" href="{{ route('instructors.create') }}">
                        <i class="ion-plus-circled"></i> {{ __('admin.Add New Instructor') }}
                    </a>
                </div>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#mentorsCollapse"
                aria-expanded="true" aria-controls="mentorsCollapse">
                <span>{{__('admin.Mentors')}}</span>
            </a>
            <div id="mentorsCollapse" class="collapse" aria-labelledby="headingMentors" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ isActiveRoute('mentors.index', 'bg-primary text-white') }}" href="{{ route('mentors.index') }}">
                        <i class="fa-solid fa-list"></i> {{ __('admin.All Mentors') }}
                    </a>
                    <a class="collapse-item {{ isActiveRoute('mentors.create', 'bg-primary text-white') }}" href="{{ route('mentors.create') }}">
                        <i class="ion-plus-circled"></i> {{ __('admin.Add New Mentor') }}
                    </a>
                </div>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#operationsCollapse"
                aria-expanded="true" aria-controls="operationsCollapse">
                <span>{{__('admin.Operations')}}</span>
            </a>
            <div id="operationsCollapse" class="collapse" aria-labelledby="headingoperations" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ isActiveRoute('operations.index', 'bg-primary text-white') }}" href="{{ route('operations.index') }}">
                        <i class="fa-solid fa-list"></i> {{ __('admin.All Operations') }}
                    </a>
                    <a class="collapse-item {{ isActiveRoute('operations.create', 'bg-primary text-white') }}" href="{{ route('operations.create') }}">
                        <i class="ion-plus-circled"></i> {{ __('admin.Add New Operation') }}
                    </a>
                </div>
            </div>
        </li>



        <!-- Nav Item - Pages Collapse Menu -->
         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSession"
                aria-expanded="true" aria-controls="collapseSession">
                <span>{{__('admin.Sessions')}}</span>
            </a>
            <div id="collapseSession" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ isActiveRoute('sessions.index', 'bg-primary text-white') }}" href="{{ route('sessions.index') }}">
                        <i class="fa-solid fa-list"></i> {{ __('admin.All Sessions') }}
                    </a>
                </div>
            </div>
        </li>


          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEvent"
                aria-expanded="true" aria-controls="collapseEvent">
                <span>{{__('admin.Events')}}</span>
            </a>
            <div id="collapseEvent" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ isActiveRoute('events', 'bg-primary text-white') }}" href="{{ route('events') }}">
                        <i class="fa-solid fa-list"></i> {{ __('admin.All Events') }}
                    </a>
                </div>
            </div>
          </li>


         <!-- Nav Item - Pages Collapse Menu -->
         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDiscount"
                aria-expanded="true" aria-controls="collapseDiscount">
                <span>{{__('admin.Discounts')}}</span>
            </a>
            <div id="collapseDiscount" class="collapse" aria-labelledby="headingDiscount" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ isActiveRoute('discounts.index', 'bg-primary text-white') }}" href="{{ route('discounts.index') }}">
                        <i class="fa-solid fa-list"></i> {{ __('admin.All Discounts') }}
                    </a>
                    <a class="collapse-item {{ isActiveRoute('discounts.create', 'bg-primary text-white') }}" href="{{ route('discounts.create') }}">
                        <i class="ion-plus-circled"></i> {{ __('admin.Add New Discount') }}
                    </a>
                  
                </div>
            </div>
        </li>


         <!-- Nav Item - Pages Collapse Menu -->
         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBundle"
                aria-expanded="true" aria-controls="collapseBundle">
                <span>{{__('admin.Bundles')}}</span>
            </a>
            <div id="collapseBundle" class="collapse" aria-labelledby="headingBundle" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ isActiveRoute('bundles.index', 'bg-primary text-white') }}" href="{{ route('bundles.index') }}">
                        <i class="fa-solid fa-list"></i> {{ __('admin.All Bundles') }}
                    </a>
                    <a class="collapse-item {{ isActiveRoute('bundles.create', 'bg-primary text-white') }}" href="{{ route('bundles.create') }}">
                        <i class="ion-plus-circled"></i> {{ __('admin.Add New Bundle') }}
                    </a>
                    <a class="collapse-item {{ isActiveRoute('bundles.trashed', 'bg-primary text-white') }}" href="{{ route('bundles.trashed') }}">
                        <i class="ion-alert"></i> {{ __('admin.All Trashed Bundles') }}
                    </a>
                </div>
            </div>
        </li>



        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecities"
                aria-expanded="true" aria-controls="collapsecities">
                <span>{{__('admin.Cities')}}</span>
            </a>
            <div id="collapsecities" class="collapse" aria-labelledby="headingcities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ isActiveRoute('cities.index', 'bg-primary text-white') }}" href="{{ route('cities.index') }}">
                        <i class="fa-solid fa-list"></i> {{ __('admin.All Cities') }}
                    </a>
                    <a class="collapse-item {{ isActiveRoute('cities.trashed', 'bg-primary text-white') }}" href="{{ route('cities.trashed') }}">
                        <i class="ion-alert"></i> {{ __('admin.All Trashed Cites') }}
                    </a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecountries"
                aria-expanded="true" aria-controls="collapsecountries">
                <span>{{__('admin.Countries')}}</span>
            </a>
            <div id="collapsecountries" class="collapse" aria-labelledby="headingcountries"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ isActiveRoute('countries.index', 'bg-primary text-white') }}" href="{{ route('countries.index') }}">
                        <i class="fa-solid fa-list"></i> {{ __('admin.All Countries') }}
                    </a>
                    <a class="collapse-item {{ isActiveRoute('countries.create', 'bg-primary text-white') }}" href="{{ route('countries.create') }}">
                        <i class="ion-plus-circled"></i> {{ __('admin.Add New Country') }}
                    </a>
                </div>
            </div>
        </li>



<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMeetings"
        aria-expanded="true" aria-controls="collapseMeetings">
        <span>{{__('admin.Blogs')}}</span>
    </a>
    <div id="collapseMeetings" class="collapse" aria-labelledby="headingMeetings"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ isActiveRoute('blogs.index', 'bg-primary text-white') }}" href="{{ route('blogs.index') }}">
                <i class="fa-solid fa-list"></i> {{ __('admin.All Blogs') }}
            </a>
            <a class="collapse-item {{ isActiveRoute('blogs.create', 'bg-primary text-white') }}" href="{{ route('blogs.create') }}">
                <i class="ion-plus-circled"></i> {{ __('admin.Add New Blog') }}
            </a>
            <a class="collapse-item {{ isActiveRoute('blogs.trashed', 'bg-primary text-white') }}" href="{{ route('blogs.trashed') }}">
                <i class="ion-alert"></i> {{ __('admin.All Trashed Blogs') }}
            </a>
    </div>
    </div>
</li>


<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAddress"
        aria-expanded="true" aria-controls="collapseAddress">
        <span>{{__('admin.Addresses')}}</span>
    </a>
    <div id="collapseAddress" class="collapse" aria-labelledby="headingAddress"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ isActiveRoute('addresses.index', 'bg-primary text-white') }}" href="{{ route('addresses.index') }}">
                <i class="fa-solid fa-list"></i> {{ __('admin.All Addresses') }}
            </a>
            <a class="collapse-item {{ isActiveRoute('addresses.create', 'bg-primary text-white') }}" href="{{ route('addresses.create') }}">
                <i class="ion-plus-circled"></i> {{ __('admin.Add New Address') }}
            </a>
    </div>
    </div>
</li>


<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsespecs"
        aria-expanded="true" aria-controls="collapsespecs">
        <span>{{__('admin.Roles')}}</span>
    </a>
    <div id="collapsespecs" class="collapse" aria-labelledby="headingspecs"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ isActiveRoute('roles.index', 'bg-primary text-white') }}" href="{{ route('roles.index') }}">
                <i class="fa-solid fa-list"></i> {{ __('admin.All Roles') }}
            </a>
            <a class="collapse-item {{ isActiveRoute('roles.create', 'bg-primary text-white') }}" href="{{ route('roles.create') }}">
                <i class="ion-plus-circled"></i> {{ __('admin.Add New Role') }}
            </a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsepermissions"
        aria-expanded="true" aria-controls="collappermissions">
        <span>{{__('admin.Permissions')}}</span>
    </a>
    <div id="collapsepermissions" class="collapse" aria-labelledby="headingpermissions"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ isActiveRoute('permissions.index', 'bg-primary text-white') }}" href="{{ route('permissions.index') }}">
                <i class="fa-solid fa-list"></i> {{ __('admin.All Permissions') }}
            </a>
            <a class="collapse-item {{ isActiveRoute('permissions.create', 'bg-primary text-white') }}" href="{{ route('permissions.create') }}">
                <i class="ion-plus-circled"></i> {{ __('admin.Add New Permission') }}
            </a>
        </div>
    </div>
</li>


<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsesuper"
        aria-expanded="true" aria-controls="collapsesuper">
        <span>{{__('admin.Super Skills')}}</span>
    </a>
    <div id="collapsesuper" class="collapse" aria-labelledby="headingpermissions"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ isActiveRoute('super-skills.index', 'bg-primary text-white') }}" href="{{ route('super-skills.index') }}">
                <i class="fa-solid fa-list"></i> {{ __('admin.All Super Skills') }}
            </a>
            <a class="collapse-item {{ isActiveRoute('super-skills.create', 'bg-primary text-white') }}" href="{{ route('super-skills.create') }}">
                <i class="ion-plus-circled"></i> {{ __('admin.Add New Super Skill') }}
            </a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseskill"
        aria-expanded="true" aria-controls="collapseskill">
        <span>{{__('admin.Skills')}}</span>
    </a>
    <div id="collapseskill" class="collapse" aria-labelledby="headingskill"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ isActiveRoute('skills.index', 'bg-primary text-white') }}" href="{{ route('skills.index') }}">
                <i class="fa-solid fa-list"></i> {{ __('admin.All Skills') }}
            </a>
            <a class="collapse-item {{ isActiveRoute('skills.create', 'bg-primary text-white') }}" href="{{ route('skills.create') }}">
                <i class="ion-plus-circled"></i> {{ __('admin.Add New Skill') }}
            </a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseroadmaps"
        aria-expanded="true" aria-controls="collapseroadmaps">
        <span>{{__('admin.Roadmaps')}}</span>
    </a>
    <div id="collapseroadmaps" class="collapse" aria-labelledby="headingroadmaps"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ isActiveRoute('roadmaps.index', 'bg-primary text-white') }}" href="{{ route('roadmaps.index') }}">
                <i class="fa-solid fa-list"></i> {{ __('admin.All Roadmaps') }}
            </a>
            <a class="collapse-item {{ isActiveRoute('roadmaps.create', 'bg-primary text-white') }}" href="{{ route('roadmaps.create') }}">
                <i class="ion-plus-circled"></i> {{ __('admin.Add New Roadmap') }}
            </a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseenroll"
        aria-expanded="true" aria-controls="collapseenroll">
        <span>{{__('admin.Enrollments')}}</span>
    </a>
    <div id="collapseenroll" class="collapse" aria-labelledby="headingenroll"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ isActiveRoute('enrollments.index', 'bg-primary text-white') }}" href="{{ route('enrollments.index') }}">
                <i class="fa-solid fa-list"></i> {{ __('admin.All Enrollments') }}
            </a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsematerial"
        aria-expanded="true" aria-controls="collapsematerial">
        <span>{{__('admin.Materials')}}</span>
    </a>
    <div id="collapsematerial" class="collapse" aria-labelledby="headingmaterial"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ isActiveRoute('materials.index', 'bg-primary text-white') }}" href="{{ route('materials.index') }}">
                <i class="fa-solid fa-list"></i> {{ __('admin.All Materials') }}
            </a>
            <a class="collapse-item {{ isActiveRoute('materials.create', 'bg-primary text-white') }}" href="{{ route('materials.create') }}">
                <i class="ion-plus-circled"></i> {{ __('admin.Add New Material') }}
            </a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsereview"
        aria-expanded="true" aria-controls="collapsematerial">
        <span>{{__('admin.Reviews')}}</span>
    </a>
    <div id="collapsereview" class="collapse" aria-labelledby="headingreview"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ isActiveRoute('reviews.index', 'bg-primary text-white') }}" href="{{ route('reviews.index') }}">
                <i class="fa-solid fa-list"></i> {{ __('admin.All Reviews') }}
            </a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsepayment"
        aria-expanded="true" aria-controls="collapsepayment">
        <span>{{__('admin.Payments')}}</span>
    </a>
    <div id="collapsepayment" class="collapse" aria-labelledby="headingpayment"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ isActiveRoute('payments.index', 'bg-primary text-white') }}" href="{{ route('payments.index') }}">
                <i class="fa-solid fa-list"></i> {{ __('admin.All Payments') }}
            </a>
        </div>
    </div>
</li>


<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapserecording"
        aria-expanded="true" aria-controls="collapserecording">
        <span>{{__('admin.Recordings')}}</span>
    </a>
    <div id="collapserecording" class="collapse" aria-labelledby="headingrecording"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ isActiveRoute('recordings.index', 'bg-primary text-white') }}" href="{{ route('recordings.index') }}">
                <i class="fa-solid fa-list"></i> {{ __('admin.All Recordings') }}
            </a>
            <a class="collapse-item {{ isActiveRoute('recordings.create', 'bg-primary text-white') }}" href="{{ route('recordings.create') }}">
                <i class="ion-plus-circled"></i> {{ __('admin.Add New Recording') }}
            </a>
        </div>
    </div>
</li>


<!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search w-50" method="get" action="{{route('search')}}">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="query" class="form-control bg-light border-0 small" placeholder="{{__('admin.Search for')}}..."
                            aria-label="Search" value="{{request('query') != "" ? request('query') : ''}}" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="copyright text-center mt-2 ms-5">
                    <h6>
                        <i class="far fa-calendar-alt"></i>  {{ now()->translatedFormat('M Y') }}
                    </h6>
                </div>

        <div class="dropdown ms-2">
            <a class="nav-link dropdown-toggle" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span>{{ __('admin.Language') }} <i class="fas fa-language"></i></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languageDropdown">
                @if ($locale === 'en')
                  <a class="dropdown-item" href="{{ route('change.language', ['locale' => 'ar']) }}">
                    <span class="fi fi-eg"></span>  العربية - AR
                  </a>
                @else
                 <a class="dropdown-item" href="{{ route('change.language', ['locale' => 'en']) }}">
                   <span class="fi fi-us"></span> English - EN
                 </a>
                @endif
         </div>
        </div>


   <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
     <li class="nav-item dropdown no-arrow d-sm-none">
     <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                            aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                        placeholder="Search for..." aria-label="Search"
                                        aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">{{ auth()->guard('admin')->user()->unreadNotifications->count() }}</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                {{ __('admin.Alerts Center') }}
                            </h6>
                            @foreach(auth()->guard('admin')->user()->unreadNotifications->sortByDesc('created_at')->take(5) as $notification)
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('notifications.show', $notification->id) }}">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">{{ $notification->created_at->diffForHumans() }}</div>
                                    <span class="font-weight-bold">{{ $notification->data['message'] }}</span>
                                </div>
                            </a>
                            @endforeach
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                @name
                            </span>
                            <img class="img-profile rounded-circle"  src="{{ auth()->guard('admin')->user()->image ? getPath('admins', auth()->guard('admin')->user()->id, auth()->guard('admin')->user()->image->path) : asset('assets/img/undraw_profile.svg') }}">
                          </a>
                       
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item {{ isActiveRoute('profile.show', 'bg-primary text-white') }}" href="{{ route('profile.show') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('admin.Profile') }}
                            </a>
                            <a class="dropdown-item {{ isActiveRoute('settings.index', 'bg-primary text-white') }}" href="{{ route('settings.index') }}">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('admin.Settings') }}
                            </a>
                            <a class="dropdown-item {{ isActiveRoute('activity-logs.index', 'bg-primary text-white') }}" href="{{ route('activity-logs.index') }}">
                                <i class="fa-solid fa-bars fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('admin.Activity Log') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{__('admin.Logout')}}
                              </a>
                           </div>
                    </li>

                </ul>

            </nav>

    <!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel">{{__('admin.Logout')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          {{__('admin.Are you sure you want to Logout?')}}
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <a class="btn btn-primary btn-lg" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{__('admin.Yes')}}</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
          <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">{{__('admin.No')}}</button>
        </div>
      </div>
    </div>
  </div>

