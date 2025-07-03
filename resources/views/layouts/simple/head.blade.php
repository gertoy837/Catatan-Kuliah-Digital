<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" type="image/png" href="{{ asset('assets') }}/img/logo_1.png">
<title>@yield('title') | Aplikasi Catatan Kuliah Digital </title>
<link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
<script src="https://kit.fontawesome.com/e2bb076cb4.js" crossorigin="anonymous"></script>
<link id="pagestyle" href="{{ asset('assets') }}/css/soft-ui-dashboard.css?v=1.1.0" rel="stylesheet" />
<x-rich-text::styles theme="richtextlaravel" data-turbo-track="false" />
@yield('head')
<style>
    .pagination .page-link {
        color: #555;
        border-radius: 50%;
        border: 1px solid #ddd;
        width: 40px;
        height: 40px;
        line-height: 38px;
        text-align: center;
        padding: 0;
        margin: 0 4px;
    }

    .pagination .page-item.active .page-link {
        background-color: #ff6a00;
        color: #fff;
        border-color: transparent;
    }

    .pagination .page-link:hover {
        background-color: #f5f5f5;
        color: #333;
    }
</style>