@include('backend.include.header')

<!-- Main Sidebar Container -->
@include('backend.include.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @yield('main_content')
</div>
<!-- /.content-wrapper -->
<!-- Footer -->
@include('backend.include.footer')

