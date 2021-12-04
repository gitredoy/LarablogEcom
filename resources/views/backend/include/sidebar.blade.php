<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home.dashboard')}}" class="brand-link">
        <img src="{{asset('public/backend')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

@php
    $prefix = Request::route()->getPrefix();
    $route  = Route::current()->getName();
@endphp

<!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img
                    src="{{empty(Auth::user()->image)?asset('public/upload/noImage.jpg'):asset('public/upload/users_image/'.Auth::user()->image)}}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('profile.view')}}" class="d-block">{{Auth::user()->name}} id: {{Auth::user()->id}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if (Auth::user()->usertype == 'admin')
                    <li class="nav-item {{request()->is('users*') ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>Manage User
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('users.view')}}"
                                   class="nav-link {{request()->is('users/view') ? 'active' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View User</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endif

                <li class="nav-item {{request()->is('profile*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Manage Profile
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('profile.view')}}"
                               class="nav-link {{request()->is('profile/view') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Profile</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{request()->is('logo*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Manage Logo
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('logo.view')}}"
                               class="nav-link {{request()->is('logo/view') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Logo</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item   {{request()->is('sliders*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Manage Slider
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('sliders.view')}}"
                               class="nav-link  {{request()->is('sliders/view') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Slider</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item   {{request()->is('client*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Manage Contact
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('communicate.view')}}"
                               class="nav-link  {{request()->is('client/message') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Message</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item   {{request()->is('category*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Manage Category
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('category.index')}}"
                               class="nav-link  {{request()->is('category') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Category</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item   {{request()->is('brand*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Manage Brand
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('brand.index')}}"
                               class="nav-link  {{request()->is('brand') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Brand</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item   {{request()->is('color*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Manage Color
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('color.index')}}"
                               class="nav-link  {{request()->is('color') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Color</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item   {{request()->is('color*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Manage Size
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('size.index')}}"
                               class="nav-link  {{request()->is('size') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Size</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item   {{request()->is('products*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Manage Product
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('products.view')}}"
                               class="nav-link  {{request()->is('products*') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Product</p>
                            </a>
                        </li>
                    </ul>
                </li>

               <li class="nav-item   {{request()->is('pp*') ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>Manage Setting
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('products.view')}}"
                                   class="nav-link  {{request()->is('products*') ? 'active' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Setting</p>
                                </a>
                            </li>
                        </ul>
                    </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
