<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')
<body data-topbar="colored">

<!-- Begin page -->
<div id="layout-wrapper">
    @include('layouts.topbar')

    <!-- ========== Left Sidebar Start ========== -->

    @include('layouts.sidebars.sidebar_'.auth()->user()->role->value)
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-0">@yield('page-title')</h4>
                        </div>
                        @yield('top-buttons')
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->

            <div class="page-content-wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- end container-fluid -->
            </div>
            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->
        @include('layouts.footer')
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="Modal"
     aria-hidden="true" id="modal"></div>
<div class="modal fade" id="confirmation-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true" id="modal">
    @include('common.confirmation-modal')
</div>
@include('layouts.scripts')

</body>
</html>
