        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('customer') }}" aria-expanded="false"><i class="fas fa-user"></i><span class="hide-menu">Manage Customer</span></a></li>
                         <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-box"></i><span class="hide-menu">Orders </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="{{ route('food') }}" class="sidebar-link"><i class="mdi mdi-food"></i><span class="hide-menu">Food </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('category') }}" class="sidebar-link"><i class="mdi mdi-food-variant"></i><span class="hide-menu"> Category </span></a></li>
                            </ul>
                        </li> 
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('tables') }}" aria-expanded="false"><i class="fas fa-box"></i><span class="hide-menu">Table Reservasion</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('menu') }}" aria-expanded="false"><i class="mdi mdi-library-books"></i><span class="hide-menu">Reports</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>