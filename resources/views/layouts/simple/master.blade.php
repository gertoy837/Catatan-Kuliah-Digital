<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.simple.head')
    @include('layouts.simple.css')
</head>

<body class="dark-only">

    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('layouts.simple.header')
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            @include('layouts.simple.sidebar')

            <div class="page-body">
                @yield('main_content')
            </div>

            @include('layouts.simple.footer')
        </div>
    </div>
    @include('layouts.simple.scripts')
    @include('admin.inc.alerts')
</body>

</html>
