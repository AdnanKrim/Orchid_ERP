<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
{{--    <a href="index3.html" class="brand-link">--}}
{{--        <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">--}}
{{--        <span class="brand-text font-weight-light">Orchid Architect's</span>--}}
{{--    </a>--}}
<!-- Dynamic With Setting Company Start-->
    @if(request()->is('add-company-info')||request()->is('allCompanyInfo'))
        @php
            $siteInfo = \App\Models\Settings\CompanyInfo::orderBy('id','desc')->get();
        @endphp
        @if(!empty($siteInfo[0]->companyName))
            <a href="index3.html" class="brand-link">
                <img src="{{asset($siteInfo[0]->logo)}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light text-center">
            {{ $siteInfo[0]->companyName}}</span>
            </a>
        @else
            <a href="#" class="brand-link">
                <a href="{{route('dashboard')}}" class="brand-link">
                    <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Orchid Architect'</span>
                </a>
            </a>
        @endif
    @else
        <a href="#" class="brand-link">
            <a href="{{route('dashboard')}}" class="brand-link">
                <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Orchid Architect'</span>
            </a>
        </a>
@endif
<!-- Dynamic With Setting Company End-->
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth()->user()->name}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
    {{--        <div class="form-inline">--}}
    {{--            <div class="input-group" data-widget="sidebar-search">--}}
    {{--                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">--}}
    {{--                <div class="input-group-append">--}}
    {{--                    <button class="btn btn-sidebar">--}}
    {{--                        <i class="fas fa-search fa-fw"></i>--}}
    {{--                    </button>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ 'dashboard' == request()->path() ? 'active':'' }}">
                        <i class="nav-icon fas fa-tachometer-alt" style="color:#fa79ba"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if(auth()->user()->roleId=== 1)
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-list" style="color:#3fff00"></i>
                            <p>
                                SALES
                                <i class="fas fa-angle-left right" style="color:#3fff00"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Category</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Total Sales</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sales Return</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link {{(request()->is('add-project-category')) || (request()->is('new-project-category')) || (request()->is('all-Project-Categories')) ? 'active':''}}">
                            <!-- <i class="nav-icon fas fa-copy"></i> -->
                            <i class="nav-icon fa-solid fa-bag-shopping" style="color:#fa79ba"></i>
                            <p>
                                PURCHASES
                                <i class="fas fa-angle-left right" style="color:#fa79ba"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview {{(request()->is('add-project-category')) || (request()->is('new-project-category')) || (request()->is ('all-Project-Categories')) ? 'navAll':''}}">
                            <li class="nav-item ">
                                <a href="{{route('all-Project-Categories')}}" class="nav-link {{ request()->is('all-Project-Categories') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Purchase Proposal</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('add-project-category')}}" class="nav-link {{ request()->is('add-project-category') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Approved Purchase Proposal</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('add-project-category')}}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> New Purchase</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('add-project-category')}}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Total Purchase List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('add-project-category')}}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Purchase Returns List</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item manu-is-opening menu-open active">
                        <a href="#" class="nav-link {{ request()->is('success-leeds-panel')?'active':'' }}">
                            <!-- <i class="nav-icon fas fa-copy"></i> -->
                            <i class="nav-icon fa-brands fa-microsoft" style="color:#3fff00"></i>
                            <p>
                                CRM
                                <i class="fas fa-angle-left right" style="color:#3fff00"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item {{(request()->is('leeds')) || (request()->is('leedsList')) || (request()->is('allLeedsGroup')) ? 'manu-is-opening menu-open active':''}}">
                                <a href="#" class="nav-link {{(request()->is('leeds')) || (request()->is('leedsList')) || (request()->is('allLeedsGroup')) ?'active':'' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Leeds<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('leeds')}}" class="nav-link {{ request()->is('leeds')?'active':'' }}">
                                            <i class="nav-icon"></i>
                                            <p>New Leeds</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('leedsList')}}" class="nav-link {{ request()->is('leedsList')?'active':'' }}">
                                            <i class="nav-icon"></i>
                                            <p>All Leeds List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('allLeedsGroup')}}" class="nav-link {{ request()->is('allLeedsGroup')?'active':'' }}">
                                            <i class="nav-icon"></i>
                                            <p>Leeds Group</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item {{(request()->is('success-leeds-panel')) || (request()->is('leedsList')) || (request()->is('allLeedsGroup')) ? 'manu-is-opening menu-open active':''}}">
                                <a href="{{route('all-success-leeds')}}" class="nav-link active">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Success Leeds</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/layout/boxed.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Clients<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon"></i>
                                            <p>New Clients</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('allClients') }}" class="nav-link">
                                            <i class="nav-icon"></i>
                                            <p>All Clients List</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon"></i>
                                            <p>Clients Group</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <!-- <i class="nav-icon fas fa-copy"></i> -->
                            <i class="nav-icon fa-brands fa-product-hunt" style="color:#fa79ba"></i>
                            <p>
                                PRODUCTS
                                <i class="fas fa-angle-left right" style="color:#fa79ba"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/categoryList" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Category</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/s-categorylist" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Sub Category</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/unit-list" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Units</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/brand-list" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Brands</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/model-list" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Model</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/size-list" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Size</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/color-list" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Color</p>
                                </a>
                            </li>
                        </ul>
                        {{--                        <ul class="nav nav-treeview">--}}
                        {{--                            <li class="nav-item">--}}
                        {{--                                <a href="{{route('add-project-category')}}" class="nav-link">--}}
                        {{--                                    <i class="far fa-circle nav-icon"></i>--}}
                        {{--                                    <p> Weight</p>--}}
                        {{--                                </a>--}}
                        {{--                            </li>--}}
                        {{--                        </ul>--}}
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/add-product" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Add Products</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/product-list" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Products List</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item" class=" {{route('all-Project-Categories') == request()->path() ? 'active' :''  }} ">
                        <a href="{{route('all-Project-Categories')}}"class="nav-link">
                            <!-- <i class="nav-icon fas fa-copy"></i> -->
                            <i class="nav-icon fa-solid fa-ticket" style="color:#3fff00"></i>
                            <p>
                                SUPPLIERS
                                <i class="fas fa-angle-left right" style="color:#3fff00"></i>
                            </p>
                        </a>
                        {{--                        <ul class="nav nav-treeview">--}}
                        {{--                            <li class="nav-item" class=" {{'all-Project-Categories' == request()->path() ? 'active' :''  }} ">--}}
                        {{--                                <a href="{{route('all-Project-Categories')}}" class="nav-link">--}}
                        {{--                                    <i class="far fa-circle nav-icon"></i>--}}
                        {{--                                    <p> Category</p>--}}
                        {{--                                </a>--}}
                        {{--                            </li>--}}
                        {{--                        </ul>--}}
                        {{--                        <ul class="nav nav-treeview">--}}
                        {{--                            <li class="nav-item">--}}
                        {{--                                <a href="{{route('add-project-category')}}" class="nav-link">--}}
                        {{--                                    <i class="far fa-circle nav-icon"></i>--}}
                        {{--                                    <p> Sub Category</p>--}}
                        {{--                                </a>--}}
                        {{--                            </li>--}}
                        {{--                        </ul>--}}
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/suppGrp-list" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Supplier Groups</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/add-supplier" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Add Supplier</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/supplier-list" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Suppliers List</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <!-- <i class="nav-icon fas fa-copy"></i> -->
                            <i class="nav-icon fa-solid fa-list-check" style="color:#fa79ba"></i>
                            <p>
                                PROJECT MANAGEMENT
                                <i class="fas fa-angle-left right" style="color:#fa79ba"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('all-Project-Categories')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Category </p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('add-project-category')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> New Project </p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('add-project-category')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> All Project List </p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('add-project-category')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Project Estimate </p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('add-project-category')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Upcoming Project </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <!-- <i class="nav-icon fas fa-copy"></i> -->
                            <i class="nav-icon fa-solid fa-anchor-lock" style="color:#3fff00"></i>
                            <p>
                                INVENTORY MANAGEMENT
                                <i class="fas fa-angle-left right" style="color:#3fff00"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('all-Project-Categories')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Stock List </p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('add-project-category')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Stock Transfers </p>
                                    <i class="fas fa-angle-left right" style="color:#3fff00"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('all-Project-Categories')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p> Add Stock Transfer </p>
                                        </a>
                                    </li>
                                </ul>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('all-Project-Categories')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p> All Stock Transfer List </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('add-project-category')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Stock Adjustments</p>
                                    <i class="fas fa-angle-left right" style="color:#3fff00"></i>
                                </a>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="{{route('all-Project-Categories')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p> Add Stock Adjustment </p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('all-Project-Categories')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p> All Stock Adjustments list </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-file-invoice" style="color:#fa79ba"></i>
                            <p>
                                ACCOUNT
                                <i class="fas fa-angle-left right" style="color:#fa79ba"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Expenses</p>
                                    <i class="fas fa-angle-left right" style="color:#3fff00"></i>
                                </a>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p> Category </p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p> Add Expense </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p> All Expenses List</i></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Transfers</i></p>
                                    <i class="fas fa-angle-left right" style="color:#3fff00"></i>
                                </a>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p> New Transfer </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p> All Transfers List</i></p>
                                        </a>
                                    </li>
                                </ul>

                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Accounts </i></p>
                                    <i class="fas fa-angle-left right" style="color:#3fff00"></i>
                                </a>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p> Add Account </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p> All Accounts List</i></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Debit Voucher </i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Credit Voucher </i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Payment </i></p>
                                    <i class="fas fa-angle-left right" style="color:#3fff00"></i>
                                </a>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p> Suppliers Payment </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Sales Payment </i></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Profit and Loss Account </i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> Banks </i></p>
                                    <i class="fas fa-angle-left right" style="color:#3fff00"></i>
                                </a>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Deposit </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Withdraw </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Balance </i></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <!-- <i class="nav-icon fas fa-copy"></i> -->
                            <i class="nav-icon fa-solid fa-person-dress-burst" style="color:#3fff00"></i>
                            <p>
                                HRM
                                <i class="fas fa-angle-left right" style="color:#3fff00"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Department</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Designation</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Employee</i></p>
                                    <i class="fas fa-angle-left right" style="color:#fa79ba"></i>
                                </a>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Attendance</i></p>
                                    <i class="fas fa-angle-left right" style="color:#fa79ba"></i>
                                </a>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Payroll</i></p>
                                    <i class="fas fa-angle-left right" style="color:#fa79ba"></i>
                                </a>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Leaves</i></p>
                                    <i class="fas fa-angle-left right" style="color:#fa79ba"></i>
                                </a>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Recruitment</i></p>
                                    <i class="fas fa-angle-left right" style="color:#fa79ba"></i>
                                </a>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Loans</i></p>
                                    <i class="fas fa-angle-left right" style="color:#fa79ba"></i>
                                </a>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Bank Name </i></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Awards</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Others</i></p>
                                    <i class="fas fa-angle-left right" style="color:#fa79ba"></i>
                                </a>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Transfers </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Resignation</i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Promotions </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Complaints </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p>Warnings </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Terminations </i></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <!-- <i class="nav-icon fas fa-copy"></i> -->
                            <i class="nav-icon fa-regular fa-file" style="color:#fa79ba"></i>
                            <p>
                                REPORT
                                <i class="fas fa-angle-left right" style="color:#fa79ba"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sale Payment Report </i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Purchase Report </i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Leeds Report</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Meeting Report </i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Clients Report </i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Project Report</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Profit & Loss Report</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Expense Report</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Due Report</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Transaction Report</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Employee Report</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Attendance Report</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Leave Report </i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Grant Loan Report</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Loan Installment Report</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Payroll Report</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sales Report</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sale Payment Report</i></p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <!-- <i class="nav-icon fas fa-copy"></i> -->
                            <i class="nav-icon fa-solid fa-people-arrows" style="color:#3fff00"></i>
                            <p>
                                FOLLOW UP
                                <i class="fas fa-angle-left right" style="color:#3fff00"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>SMS</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Email</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Whatsapp</i></p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <!-- <i class="nav-icon fas fa-copy"></i> -->
                            <i class="nav-icon fa-solid fa-users" style="color:#fa79ba"></i>
                            <p>
                                USER MANAGEMENT
                                <i class="fas fa-angle-left right" style="color:#fa79ba"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('roleList')}}"  class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Role</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('userList')}}"  class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('menuList')}}"  class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Menu</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('SubmenuList')}}"  class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sub Menu</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('menuPermission')}}"  class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Menu Permission</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#"  class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Profile</i></p>
                                    <i class="fas fa-angle-left right" style="color:#fa79ba"></i>
                                </a>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p>Your Profile </i></p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview icon-left-padding">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fa-solid fa-arrow-right" style="color:#3fff00"></i>
                                            <p> Change Password </i></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <!-- <i class="nav-icon fas fa-copy"></i> -->
                            <i class="nav-icon fa-solid fa-user-astronaut" style="color:#3fff00"></i>
                            <p>
                                COMMISSION MANAGEMENT
                                <i class="fas fa-angle-left right" style="color:#3fff00"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#"  class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sale Commission</i></p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#"  class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Join Commission</i></p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('allCompanyInfo')}}" class="nav-link {{(request()->is('allCompanyInfo')) || (request()->is('add-company-info')) ? 'active':''}}">
                            <!-- <i class="nav-icon fas fa-copy"></i> -->
                            <i class="nav-icon fa-solid fa-gear" style="color:#fa79ba"></i>
                            <p>
                                Settings
                                <i class="fas fa-angle-left right" style="color:#3fff00"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview {{(request()->is('allCompanyInfo'))||(request()->is('add-company-info')) ? 'navAll':''}}" >
                            <li class="nav-item {{  request()->routeIs('allCompanyInfo') ? 'active' : '' }}">
                                <a href="{{ route('allCompanyInfo')}}" class="nav-link {{(request()->is('allCompanyInfo')) ? 'active':''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Company Info</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('add-company-info')}}" class="nav-link {{(request()->is('add-company-info')) ? 'active':''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Company</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-item text-primary" href="{{ route('updateAdminPassword')}}">
                            <i class="fa-solid fa-user me-2" style="color:#ffc107"></i>
                            Change Password
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="dropdown-item text-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}<i class="fas fa-lock nav-icon text-primary"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
