<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion pr-0" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon">
        <i class="fas fa-store"></i>
      </div>
      <div class="sidebar-brand-text mx-3">{{ __('فروشگاه لاراول') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span> {{ __('داشبورد') }} </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true"
        aria-controls="collapsePages">
        <i class="fas fa-fw fa-socks"></i>
        <span>{{ __('محصولات') }}</span>
      </a>
      <div id="collapseProducts" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          {{-- Attribute Sidebar Item --}}
          <h6 class="collapse-header"> {{ __('ویژگی ها') }} : </h6>
          <a class="collapse-item" href="{{ route('admin.attributes.index') }}">
            <i class="fa fa-eye"></i>
            {{ __('نمایش ویژگی ها') }}
          </a>
          <a class="collapse-item" href="{{ route('admin.attributes.create') }}">
            <i class="fa fa-plus"></i>
            {{ __('ایجاد ویژگی') }}
          </a>

          {{-- divider --}}
          <div class="collapse-divider"></div>

          {{-- Brand Sidebar Item --}}
          <h6 class="collapse-header"> {{ __('برندها') }} : </h6>
          <a class="collapse-item" href="{{ route('admin.brands.index') }}">
            <i class="fa fa-eye"></i>
            {{ __('نمایش برندها') }}
          </a>
          <a class="collapse-item" href="{{ route('admin.brands.create') }}">
            <i class="fa fa-plus"></i>
            {{ __('ایجاد برند') }}
          </a>

        {{-- divider --}}
          <div class="collapse-divider"></div>

          {{-- Categories Sidebar Item --}}
          <h6 class="collapse-header"> {{ __('دسته بندی') }} : </h6>
          <a class="collapse-item" href="{{ route('admin.categories.index') }}">
            <i class="fa fa-eye"></i>
            {{ __('نمایش دسته بندی') }}
          </a>
          <a class="collapse-item" href="{{ route('admin.categories.create') }}">
            <i class="fa fa-plus"></i>
            {{ __('ایجاد دسته بندی') }}
          </a>

        {{-- divider --}}
        <div class="collapse-divider"></div>

        {{-- tags Sidebar Item --}}
        <h6 class="collapse-header"> {{ __('تگ ها') }} : </h6>
        <a class="collapse-item" href="{{ route('admin.tags.index') }}">
            <i class="fa fa-eye"></i>
            {{ __('نمایش تگ ها') }}
        </a>
        <a class="collapse-item" href="{{ route('admin.tags.create') }}">
            <i class="fa fa-plus"></i>
            {{ __('ایجاد تگ') }}
        </a>
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

  </ul>
