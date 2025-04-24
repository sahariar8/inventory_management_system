<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ asset('upload/admin_images/'.Auth::user()->image) }}" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ Auth::user()->name }}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="" class="waves-effect">
                        {{-- <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span> --}}
                        <a href="{{ url('/dashboard') }}" class="waves-effect">
                            <i class="fa-solid fa-house-chimney"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-hotel-fill"></i>
                        <span>Manage Suppliers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('supplier.all') }}">All Suppliers</a></li>
                        {{-- <li><a href="#">Add Suppliers</a></li> --}}
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-shield-user-fill"></i>
                        <span>Manage Customers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('customer.all') }}">All Customers</a></li>
                        <li><a href="{{ route('credit.customer') }}">Credit Customers</a></li>
                        <li><a href="{{ route('paid.customer') }}">Paid Customers</a></li>
                        <li><a href="{{ route('customer.wise.report') }}">Customer Wise Report</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-delete-back-fill"></i>
                        <span>Manage Units</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('unit.all') }}">All Unit</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-apps-2-fill"></i>
                        <span>Manage Category</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('category.all') }}">All Category</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-reddit-fill"></i>
                        <span>Manage Product</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('product.all') }}">All Product</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-oil-fill"></i>
                        <span>Manage Purchase</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('purchase.all') }}">All Purchase</a></li>
                        <li><a href="{{ route('purchase.pending') }}">Approval Purchase</a></li>
                        <li><a href="{{ route('daily.purchase.report') }}">Daily Purchase Report</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-compass-2-fill"></i>
                        <span>Manage Invoice</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('invoice.all') }}">All Invoice</a></li>
                        <li><a href="{{ route('invoice.pending') }}">Approval Invoice</a></li>
                        <li><a href="{{ route('print.invoice.list') }}">Print Invoice List</a></li>
                        <li><a href="{{ route('daily.invoice.report') }}">Daily Invoice Report</a></li>
                    </ul>
                </li>

                <li class="menu-title">Stock</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-gift-fill"></i>
                        <span>Manage Stock</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('stock.report') }}">Stock Report</a></li>
                        <li><a href="{{ route('stock.supplier.wise') }}">Supplier/Product wise Report</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-profile-line"></i>
                        <span>Support</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-starter.html">Starter Page</a></li>
                
                    </ul>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-account-circle-line"></i>
                        <span>Authentication</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Login</a></li>
                    </ul>
                </li>

                <li class="menu-title">Components</li> --}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>