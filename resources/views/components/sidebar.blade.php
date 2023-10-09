 <!--  BEGIN SIDEBAR  -->
 <div class="sidebar-wrapper sidebar-theme">
     <nav id="sidebar">
         <div class="navbar-nav theme-brand flex-row  text-center">
             <div class="nav-logo">
                 <div class="nav-item theme-logo">
                     <a href="#">
                         <img src="/assets/img/logo.svg" class="navbar-logo" alt="logo">
                     </a>
                 </div>
                 <div class="nav-item theme-text">
                     <a href="#" class="nav-link"> RENAV CRM </a>
                 </div>
             </div>
             <div class="nav-item sidebar-toggle">
                 <div class="btn-toggle sidebarCollapse">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="feather feather-chevrons-left">
                         <polyline points="11 17 6 12 11 7"></polyline>
                         <polyline points="18 17 13 12 18 7"></polyline>
                     </svg>
                 </div>
             </div>
         </div>
         <div class="shadow-bottom"></div>
         <ul class="list-unstyled menu-categories" id="accordionExample">
             <li class="menu {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                 <a href="{{ route('dashboard') }}" class="dropdown-toggle collapsed">
                     <div class="">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-home">
                             <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                             <polyline points="9 22 9 12 15 12 15 22"></polyline>
                         </svg>
                         <span>Dashboard</span>
                     </div>
                 </a>
             </li>


             @if (auth()->user()->role != 0)
                 <li class="menu {{ Str::startsWith(Route::currentRouteName(), 'user') ? 'active' : '' }}">
                     <a href="#user" data-bs-toggle="collapse"
                         aria-expanded="{{ Str::startsWith(Route::currentRouteName(), 'user') ? 'true' : 'false' }}"
                         class="dropdown-toggle collapsed">
                         <div>

                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-users">
                                 <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                 <circle cx="9" cy="7" r="4"></circle>
                                 <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                 <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                             </svg>
                             <span>User</span>
                         </div>
                         <div>
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-chevron-right">
                                 <polyline points="9 18 15 12 9 6"></polyline>
                             </svg>
                         </div>
                     </a>
                     <ul class="submenu list-unstyled collapse {{ Str::startsWith(Route::currentRouteName(), 'user') ? 'show' : '' }}"
                         id="user" data-bs-parent="#accordionExample">


                         <li class="{{ Route::currentRouteName() == 'user.index' ? 'active' : '' }}">
                             <a href="{{ route('user.index') }}"> List of user </a>
                         </li>
                         <li class="{{ Route::currentRouteName() == 'user.create' ? 'active' : '' }}">
                             <a href="{{ route('user.create') }}"> Add a user </a>
                         </li>

                     </ul>
                 </li>
             @endif

             @if (Auth::user()->role == 2)
                 <li class="menu {{ Str::startsWith(Route::currentRouteName(), 'department') ? 'active' : '' }}">
                     <a href="#department" data-bs-toggle="collapse"
                         aria-expanded="{{ Str::startsWith(Route::currentRouteName(), 'department') ? 'true' : 'false' }}"
                         class="dropdown-toggle collapsed">
                         <div>


                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-briefcase">
                                 <rect x="2" y="7" width="20" height="14" rx="2"
                                     ry="2"></rect>
                                 <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                             </svg>

                             <span>Department</span>
                         </div>
                         <div>
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-chevron-right">
                                 <polyline points="9 18 15 12 9 6"></polyline>
                             </svg>
                         </div>
                     </a>
                     <ul class="submenu list-unstyled collapse {{ Str::startsWith(Route::currentRouteName(), 'department') ? 'show' : '' }}"
                         id="department" data-bs-parent="#accordionExample">


                         <li class="{{ Route::currentRouteName() == 'department.index' ? 'active' : '' }}">
                             <a href="{{ route('department.index') }}"> List of Department </a>
                         </li>
                         <li class="{{ Route::currentRouteName() == 'department.create' ? 'active' : '' }}">
                             <a href="{{ route('department.create') }}"> Add a Department </a>
                         </li>

                     </ul>
                 </li>
             @endif

             <li class="menu {{ Str::startsWith(Route::currentRouteName(), 'leave') ? 'active' : '' }}">
                 <a href="#leave" data-bs-toggle="collapse"
                     aria-expanded="{{ Str::startsWith(Route::currentRouteName(), 'leave') ? 'true' : 'false' }}"
                     class="dropdown-toggle collapsed">
                     <div>


                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-briefcase">
                             <rect x="2" y="7" width="20" height="14" rx="2"
                                 ry="2"></rect>
                             <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                         </svg>

                         <span>Leave</span>
                     </div>
                     <div>
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-chevron-right">
                             <polyline points="9 18 15 12 9 6"></polyline>
                         </svg>
                     </div>
                 </a>
                 <ul class="submenu list-unstyled collapse {{ Str::startsWith(Route::currentRouteName(), 'leave') ? 'show' : '' }}"
                     id="leave" data-bs-parent="#accordionExample">

                     @if (Auth::user()->role != 0)
                         <li class="{{ Route::currentRouteName() == 'leave.index' ? 'active' : '' }}">
                             <a href="{{ route('leave.index') }}">
                                 Waiting for approval
                             </a>
                         </li>
                         <li class="{{ Route::currentRouteName() == 'leave.approved' ? 'active' : '' }}">
                             <a href="{{ route('leave.approved') }}"> Approved Leave </a>
                         </li>

                         <li class="{{ Route::currentRouteName() == 'leave.rejected' ? 'active' : '' }}">
                             <a href="{{ route('leave.rejected') }}"> Rejected Leave </a>
                         </li>
                     @endif

                     @if (Auth::user()->role != 2)
                         <li class="{{ Route::currentRouteName() == 'leave.myleave' ? 'active' : '' }}">
                             <a href="{{ route('leave.myleave') }}"> My Leave </a>
                         </li>
                         <li class="{{ Route::currentRouteName() == 'leave.create' ? 'active' : '' }}">
                             <a href="{{ route('leave.create') }}"> Apply for Leave </a>
                         </li>
                         {{-- <li class="{{ Route::currentRouteName() == 'leave.requesting' ? 'active' : '' }}">
                             <a href="{{ route('leave.requesting') }}">
                                 Leave Request by <br> others
                             </a>
                         </li> --}}
                     @endif

                 </ul>
             </li>

             <li class="menu menu-heading">
                 <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                         <line x1="5" y1="12" x2="19" y2="12"></line>
                     </svg><span>APPLICATIONS</span></div>
             </li>
         </ul>
     </nav>
 </div>
 <!--  END SIDEBAR  -->
