 <!-- ========== Left Sidebar Start ========== -->
 <div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{asset('backend/images/users/avatar-1.jpg')}}" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">Julia Hudda</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{route('home')}}" class="waves-effect">
                        <i class="ri-home-4-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-title">Workforce Management</li>
                <li>
                    <a href="{{route('manage.pos')}}" class="waves-effect">
                        <i class="ri-calculator-line"></i>
                        <span>POS</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="dripicons-user-group"></i>
                        <span>Employees</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('add.employees')}}"> <i class="ri-arrow-right-s-fill"></i> Add New</a></li>
                        <li><a href="{{route('manage.employees')}}"><i class="ri-arrow-right-s-fill"></i> Show All</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-user-unfollow-line"></i>
                        <span>Attendance</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('take.attendance')}}"> <i class="ri-arrow-right-s-fill"></i> Take Attendence </a></li>
                        <li><a href="{{route('manage.attendance')}}"><i class="ri-arrow-right-s-fill"></i> All Attendences</a></li>
                        <li><a href="{{route('month.attendance')}}"><i class="ri-arrow-right-s-fill"></i> Monthly Attendences</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class=" ri-customer-service-2-line"></i>
                        <span>Customer</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('add.customer')}}"> <i class="ri-arrow-right-s-fill"></i> Add New</a></li>
                        <li><a href="{{route('manage.customer')}}"><i class="ri-arrow-right-s-fill"></i> Show All</a></li>
                    </ul>
                </li>

                <li class="menu-title">Supplier Administration</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class=" ri-hand-coin-line"></i>
                        <span>Suppliers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('add.supplier')}}"> <i class="ri-arrow-right-s-fill"></i> Add New</a></li>
                        <li><a href="{{route('manage.supplier')}}"><i class="ri-arrow-right-s-fill"></i> Show All</a></li>
                    </ul>
                </li>

                <li class="menu-title">Payroll Management</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-currency-fill"></i>
                        <span>Salaries (EMP)</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('add.advsalary')}}"> <i class="ri-arrow-right-s-fill"></i> Add Advance Salary</a></li>
                        <li><a href="{{route('manage.advsalary')}}"><i class="ri-arrow-right-s-fill"></i> All Advance Salary</a></li>
                        <li><a href="{{route('pay.salary')}}"><i class="ri-arrow-right-s-fill"></i> Pay Salary </a></li>
                        <li><a href="{{route('add.advsalary')}}"><i class="ri-arrow-right-s-fill"></i> Last Month Salary </a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-creative-commons-nc-line"></i>
                        <span>Expenses</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('add.expenses')}}"> <i class="ri-arrow-right-s-fill"></i> Add Expense</a></li>
                        <li><a href="{{route('manage.expenses')}}"><i class="ri-arrow-right-s-fill"></i> All Expenses</a></li>
                    </ul>
                </li>

                <li class="menu-title">Product Management</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Category</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('add.category')}}"> <i class="ri-arrow-right-s-fill"></i> Add New Category </a></li>
                        <li><a href="{{route('manage.category')}}"><i class="ri-arrow-right-s-fill"></i> All Category</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-gift-line"></i>
                        <span>Product</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('add.product')}}"> <i class="ri-arrow-right-s-fill"></i> Add New Product </a></li>
                        <li><a href="{{route('manage.product')}}"><i class="ri-arrow-right-s-fill"></i> All Products</a></li>
                        <li><a href="{{route('import.product')}}"><i class="ri-arrow-right-s-fill"></i> Import & Export Product </a></li>
                    </ul>
                </li>

                <li class="menu-title">Order Management</li>
                <li>
                    <a href="{{route('manage.order')}}" class=" waves-effect">
                        <i class=" ri-gift-2-fill"></i>
                        <span>All Order List</span>
                    </a>
                </li>

                <li class="menu-title">PLATFORM SETTINGS</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-settings-2-line align-middle me-1"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('manage.settings')}}"> <i class="ri-arrow-right-s-fill"></i> Genarel Settings </a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->