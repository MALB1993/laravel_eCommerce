<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">پنل مدیریت</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('*/management') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin-panel.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Store') }}
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
            <i class="fas fa-fw fa-users"></i>
            <span>{{ __('Users') }}</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{ __('Client') }}</h6>
                <a class="collapse-item" href="{{ route('admin-panel.users.index') }}">لیست کاربران</a> 
                <a class="collapse-item" href="">گروه های کاربری</a>
                <a class="collapse-item" href="{{ route('admin-panel.permissions.index') }}">پرمیژن</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true" aria-controls="collapseProducts">
            <i class="fas fa-fw fa-cart-plus"></i>
            <span>{{ __('Products') }}</span>
        </a>
        <div id="collapseProducts" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{ __('Attribute') }}</h6>
                <a class="collapse-item" href="{{ route('admin-panel.products.index') }}">{{ __('Products') }}</a>
                <a class="collapse-item" href="{{ route('admin-panel.attributes.index') }}">{{ __('Attributes') }}</a>
                <a class="collapse-item" href="{{ route('admin-panel.tags.index') }}">{{ __('Tags') }}</a>
                <a class="collapse-item" href="{{ route('admin-panel.brands.index') }}">{{ __('brands') }}</a>
                <a class="collapse-item" href="{{ route('admin-panel.categories.index') }}">{{ __('categories') }}</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseOrders" aria-expanded="true" aria-controls="collapseOrders">
            <i class="fas fa-fw fa-cart-plus"></i>
            <span>{{ __('Orders') }}</span>
        </a>
        <div id="collapseOrders" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin-panel.coupons.index') }}">{{ __('Coupon') }}</a>
                <a class="collapse-item" href="{{ route('admin-panel.orders.index') }}">{{ __('Orders') }}</a>
                <a class="collapse-item" href="{{ route('admin-panel.transactions.index') }}">{{ __('Transaction') }}</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseSettings" aria-expanded="true" aria-controls="collapseSettings">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{ __('Settings') }}</span>
        </a>
        <div id="collapseSettings" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin-panel.banners.index') }}">{{ __('Index banners') }}</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('*/comments') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin-panel.comments.index') }}">
            <i class="fas fa-fw fa-comments"></i>
            <span>{{ __('Comments') }}</span>
        </a>
    </li>


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
