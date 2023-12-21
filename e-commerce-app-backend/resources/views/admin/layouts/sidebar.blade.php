<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">E-commerce</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin/categories') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('categories.index') }}">
            <i class="fa fa-list-alt"></i>
            <span>Category</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin/products') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('products.index') }}">
            <i class="fa-solid fa-briefcase"></i>
            <span>Product</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin/product-add-transaction') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('product-add-transaction.index') }}?product=add">
            <i class="fa fa-exchange"></i>
            <span>Product Transactions</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin/orders') ? 'active' : '' }}">
        <a class="nav-link" href="">
            <i class="fa fa-shopping-cart"></i>
            <span>Orders</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->is('admin/user/*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-user"></i>
            <span>User</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('admin/user/edit') ? 'active' : '' }}"
                    href="{{ route('admin.user.edit') }}">Edit Profile</a>
                <a class="collapse-item {{ request()->is('admin/user/update-password') ? 'active' : '' }}"
                    href="{{ route('admin.user.updatePassword') }}">Update Password</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
