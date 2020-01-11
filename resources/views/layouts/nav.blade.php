<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Dashboard</a>
        <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
                <div class="left-sidebar-content">
                    <ul class="sidebar-elements">
                        <li class="divider">Menu</li>
                        <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="{{ url('dashboard') }}"><i class="icon mdi mdi-home"></i><span>Dashboard</span></a>
                        </li>

                        <li class="{{ Request::is('category') ? 'active' : '' }}"><a href="{{ url('category') }}"><i class="icon mdi mdi-calendar"></i><span>Categories</span></a>
                        </li>


                        <li class="parent  {{ Request::is('product*') ? 'active' : '' }}"><a href="#"><i class="icon mdi mdi-pocket"></i><span>Products</span></a>
                            <ul class="sub-menu">

                                <li class="{{ Request::is('product/new') ? 'active' : '' }}">
                                    <a href="{{ url('product/new') }}" class="menu-item">New Product</a>
                                </li>
                                 <li class="{{ Request::is('product/bulk') ? 'active' : '' }}">
                                    <a href="{{ url('product/bulk') }}" class="menu-item">Bulk Products</a>
                                </li>
                                <li class="{{ Request::is('product/all') ? 'active' : '' }}">
                                    <a href="{{ url('product/all') }}" class="menu-item">All Products</a>
                                </li>
                                <li class="{{ Request::is('product/featured') ? 'active' : '' }}">
                                    <a href="{{ url('product/featured') }}" class="menu-item">Featured Products</a>
                                </li>
                            </ul>
                        </li>

                        <li class="{{ Request::is('banners') ? 'active' : '' }}"><a href="{{ url('banners') }}"><i class="icon mdi mdi-accounts-list"></i><span>Banners</span></a>
                        </li>
                        <li class="{{ Request::is('promotions') ? 'active' : '' }}"><a href="{{ url('promotions') }}"><i class="icon mdi mdi-android"></i><span>Promotions</span></a>
                        </li>


                        <li class="{{ Request::is('orders') ? 'active' : '' }}"><a href="{{ url('orders') }}"><i class="icon mdi mdi-android"></i><span>Orders</span></a>
                        </li>


                        <li class="parent  {{ Request::is('users*') ? 'active' : '' }}"><a href="#"><i class="icon mdi mdi-account"></i><span>User Management</span></a>
                            <ul class="sub-menu">

                                <li class="{{ Request::is('users/customers') ? 'active' : '' }}">
                                    <a href="{{ url('users/customers') }}" class="menu-item">Customers</a>
                                </li>
                                <li class="{{ Request::is('users/system') ? 'active' : '' }}">
                                    <a href="{{ url('users/system') }}" class="menu-item">System Users</a>
                                </li>

                            </ul>
                        </li>

                        <li class="{{ Request::is('reports') ? 'active' : '' }}"><a href="{{ url('reports') }}"><i class="icon mdi mdi-settings"></i><span>Reports</span></a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>