<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/admin/home')}}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
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
                    <a class="collapse-item" href="{{route('courses.index')}}"><i class="fa-solid fa-list"></i> {{__('admin.All Courses')}}</a>
                    <a class="collapse-item" href="{{route('courses.create')}}"><i class="ion-plus-circled"></i> {{__('admin.Add New Course')}}</a>
                    <a class="collapse-item" href="{{route('courses.trashed')}}"><i class="ion-alert"></i> All Trashed Courses</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#usersCollapse"
                aria-expanded="true" aria-controls="usersCollapse">
                <span>{{__('admin.Users')}}</span>
            </a>
            <div id="usersCollapse" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('users.index') }}"><i class="fa-solid fa-list"></i> {{__('admin.All Users')}}</a>
                    <a class="collapse-item" href="{{route('users.create')}}"><i class="ion-plus-circled"></i> {{__('admin.Add New User')}}</a>
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
                    <a class="collapse-item" href="{{route('categories.index')}}"><i class="fa-solid fa-list"></i> {{__('admin.All Categories')}}</a>
                    <a class="collapse-item" href="{{route('categories.create')}}"><i class="ion-plus-circled"></i> {{__('admin.Add New Category')}}</a>
                    <a class="collapse-item" href="{{route('categories.trashed')}}"><i class="ion-alert"></i> All Trashed Categories</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                aria-expanded="true" aria-controls="collapseTwo">
                <span>{{__('admin.Objectives')}}</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('objectives.index')}}"><i class="fa-solid fa-list"></i> {{__('admin.All Objectives')}}</a>
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
                    <a class="collapse-item" href="{{ route('cities.index') }}"><i class="fa-solid fa-list"></i> {{__('admin.All Cities')}}</a>
                    <a class="collapse-item" href="{{route('cities.trashed')}}"><i class="ion-alert"></i> All Trashed Cities</a>
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
            <a class="collapse-item" href="{{route('blogs.index')}}"><i class="fa-solid fa-list"></i> {{__('admin.All Blogs')}}</a>
            <a class="collapse-item" href="{{ route('blogs.create') }}"><i class="ion-plus-circled"></i> {{__('admin.Add New Blog')}}</a>
            <a class="collapse-item" href="{{route('blogs.trashed')}}"><i class="ion-alert"></i> All Trashed Blogs</a>
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
            <a class="collapse-item" href="{{route('roles.index')}}"><i class="fa-solid fa-list"></i> {{__('admin.All Roles')}}</a>
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
            <a class="collapse-item" href="{{route('permissions.index')}}"><i class="fa-solid fa-list"></i> {{__('admin.All Permissions')}}</a>
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
            <a class="collapse-item" href="{{route('super-skills.index')}}"><i class="fa-solid fa-list"></i> {{__('admin.All Super Skills')}}</a>
            <a class="collapse-item" href="{{ route('super-skills.create') }}"><i class="ion-plus-circled"></i> {{__('admin.Add Super Skill')}}</a>

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
            <a class="collapse-item" href="{{route('skills.index')}}"><i class="fa-solid fa-list"></i> {{__('admin.All Skills')}}</a>
            <a class="collapse-item" href="{{ route('skills.create') }}"><i class="ion-plus-circled"></i> {{__('admin.Add New Skill')}}</a>

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
            <a class="collapse-item" href="{{route('roadmaps.index')}}"><i class="fa-solid fa-list"></i> {{__('admin.All Roadmaps')}}</a>
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
            <a class="collapse-item" href="{{route('enrollments.index')}}"><i class="fa-solid fa-list"></i> All Enrollments</a>
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
            <a class="collapse-item" href="{{route('materials.index')}}"><i class="fa-solid fa-list"></i> All Materials</a>
            <a class="collapse-item" href="{{ route('materials.create') }}"><i class="ion-plus-circled"></i> Add New Material</a>
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
            <a class="collapse-item" href="{{route('reviews.index')}}"><i class="fa-solid fa-list"></i> {{__('admin.All Reviews')}}</a>
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
            <a class="collapse-item" href="{{route('payments.index')}}"><i class="fa-solid fa-list"></i> {{__('admin.All Payments')}}</a>
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
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="get" action="{{route('search')}}">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="query" class="form-control bg-light border-0 small" placeholder="{{__('admin.Search for')}}..."
                            aria-label="Search" value="{{request('query') != "" ? request('query') : ''}}" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary ms-2" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>

                        </div>
                    </div>
                </form>

                <div class="copyright text-center mt-2 ms-3">
                    <h6>{{ date("d M Y") }}</h6>
                </div>

     <div class="dropdown ms-5">
       <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="languageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{__('admin.Language')}}
       </button>
    <div class="dropdown-menu" aria-labelledby="languageDropdown">
      <a class="dropdown-item" href="{{ route('change.language',['locale' => 'en']) }}"> <span class="fi fi-us"></span> English - EN</a>
      <a class="dropdown-item" href="{{ route('change.language', ['locale' => 'ar']) }}"> <span class="fi fi-eg"></span> العربية - AR</a>
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
                            <span class="badge badge-danger badge-counter">3+</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 12, 2019</div>
                                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-donate text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 7, 2019</div>
                                    $290.29 has been deposited into your account!
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 2, 2019</div>
                                    Spending Alert: We've noticed unusually high spending for your account.
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </li>

                    <!-- Nav Item - Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <!-- Counter - Messages -->
                            <span class="badge badge-danger badge-counter">7</span>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                                Message Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="{{asset('assets/img/undraw_profile_1.svg')}}"
                                        alt="...">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                        problem I've been having.</div>
                                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="{{asset('assets/img/undraw_profile_2.svg')}}"
                                        alt="...">
                                    <div class="status-indicator"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">I have the photos that you ordered last month, how
                                        would you like them sent to you?</div>
                                    <div class="small text-gray-500">Jae Chun · 1d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="{{asset('assets/img/undraw_profile_3.svg')}}"
                                        alt="...">
                                    <div class="status-indicator bg-warning"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Last month's report looks great, I am very happy with
                                        the progress so far, keep up the good work!</div>
                                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                        told me that people say this to all dogs, even if they aren't good...</div>
                                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
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

                            <img class="img-profile rounded-circle"
                                src="{{asset('assets/img/undraw_profile.svg')}}">
                        </a>
                       
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{route('profile.show')}}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{__('admin.Profile')}}
                            </a>
                            <a class="dropdown-item" href="{{ route('settings.index') }}">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{__('admin.Settings')}}
                            </a>

                            <a class="dropdown-item" href="{{route('activity-logs.index')}}">
                                <i class="fa-solid fa-bars fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
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

