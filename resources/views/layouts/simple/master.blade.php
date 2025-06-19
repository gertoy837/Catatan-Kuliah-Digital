<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.simple.head')
</head>

<body class="g-sidenav-show  bg-gray-100">
    @include('layouts.simple.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('layouts.simple.header')

        <div class="container-fluid py-4">
            @yield('main_content')

            @include('layouts.simple.footer')
        </div>
    </main>
    @include('layouts.simple.scripts')

</body>

</html>
