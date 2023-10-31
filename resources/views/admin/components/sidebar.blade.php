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
            <span>داشبورد</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Store') }}
    </div>

    <li class="nav-item {{ request()->is('*/brands') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin-panel.brands.index') }}">
            <i class="fa fa-fw fa-store"></i>
            <span>{{ __('brands') }}</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>دسته‌بندی‌ها</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">مدیریت دسته‌بندی‌ها</h6>
                <a class="collapse-item" href="buttons.html">ساخت دسته‌بندی جدید</a>
                <a class="collapse-item" href="cards.html">نمایش دسته‌بندی‌ها</a>
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
