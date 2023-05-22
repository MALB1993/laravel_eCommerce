<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ env('APP_NAME') }} - @yield('title')</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('/admin/assets/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="{{ asset('/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <!-- sweet alert -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">

  <!-- sweet alert -->
  <link rel="stylesheet" href="{{ asset('/admin/css/bootstrap-select.min.css') }}">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('Admin.sections.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('Admin.sections.topbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          @yield('content')
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      @include('admin.sections.footer')
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  @include('Admin.sections.scroll_top')



  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('/admin/assets/jquery/jquery.min.js') }}"></script>
  <script src="{{  asset('/admin/assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{  asset('/admin/assets/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('/admin/js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('/admin/assets/chart.js/Chart.min.js') }}"></script>

  <!-- sweet alert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>

  <!-- sweet alert -->
  <script src="{{ asset('/admin/js/bootstrap-select.min.js') }}"></script>
  <script src="{{ asset('/admin/js/bootstrap-select-fa_IR.js') }}"></script>

  {{-- scripts --}}
  @yield('scripts')
  @include('sweetalert::alert')
</body>

</html>