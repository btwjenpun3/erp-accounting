<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Kindy Data IT Inventory adalah Custom ERP Software Web Based  untuk Perusahaan Manufacture yang handal dan integrated yang disesuaikan dengan proses bisnis perusahan Kawasan Berikat dan fasilitas KITE dengan biaya yang sangat murah.">
    <meta name="keywords"
        content="erp, erp manufacture, erp custom, it inventory, it inventory kawasan berikat, erp kawasan berikat">
    <meta name="author" content="pixelstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="/assets/images/favicon.png" type="image/x-icon">
    <title>Kindy Data Accounting</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/animate.css">

    <link rel="stylesheet" type="text/css" href="/assets/css/toastify.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link id="color" rel="stylesheet" href="/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">
    <style>
        label.required::after {
            content: " *";
            color: red;
            font-weight: bold;
        }

        .table-nowrap td,
        .table-nowrap th {
            white-space: nowrap;
        }

        input[readonly] {
            background-color: #f0f0f0;
            color: #333;
            cursor: not-allowed;
        }

        .col-5 {
            width: 5%;
        }

        .col-10 {
            width: 10%;
        }

        .col-60 {
            width: 60%;
        }

        .col-30 {
            width: 30%;
            text-align: center;
        }

        .dropdown-toggle:hover {
            background-color: #79d38e;
            border-color: #218838;
            color: #fff;
        }

        /* Hover style untuk item dropdown */
        .dropdown-menu .dropdown-item:hover {
            background-color: #939694;
            color: #e7ebe8;
            font-weight: bold;
        }

        .dropdown-menu .dropdown-item.text-success:hover {
            background-color: #d4edda;
            color: #155724;
            font-weight: bold;/
        }
    </style>
    @yield('css')
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    @livewireStyles()
</head>

<body>
    <div class="loader-wrapper">
        <div class="loader loader-1">
            <div class="loader-outter"></div>
            <div class="loader-inner"></div>
            <div class="loader-inner-1"></div>
        </div>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <div class="page-header row">
            <div class="header-logo-wrapper col-auto">
                <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light"
                            src="/assets/images/logo/logo.png" alt="" /><img class="img-fluid for-dark"
                            src="/assets/images/logo/logo_light.png" alt="" /></a></div>
            </div>

            <x-breadcrumb-component />

            <!-- Page Header Start-->
            @include('partials.header')
            <!-- Page Header Ends                              -->
        </div>

        <!-- Page Body Start-->
        <div class="page-body-wrapper">

            <!-- Page Sidebar Start-->
            @include('partials.sidebar')
            <!-- Page Sidebar Ends-->

            <div class="page-body">

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    @if (session()->has('success'))
                        <div class="alert alert-success dark" role="alert">
                            <div class="d-flex justify-content-between">
                                {{ session('success') }}
                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger dark" role="alert">
                            <div class="d-flex justify-content-between">
                                {{ session('error') }}
                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @yield('content')
                </div>
                <!-- Container-fluid Ends-->

            </div>

            <!-- footer start-->
            @include('partials.footer')
            <!-- footer end -->

            @livewire('notification.toastify')
        </div>
    </div>
    <!-- latest jquery-->
    @livewireScripts()
    <!-- Bootstrap js-->
    <script src="/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="/assets/js/scrollbar/simplebar.js"></script>
    <script src="/assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="/assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="/assets/js/sidebar-menu.js"></script>
    <script src="/assets/js/sidebar-pin.js"></script>
    <script src="/assets/js/slick/slick.min.js"></script>
    <script src="/assets/js/slick/slick.js"></script>
    <script src="/assets/js/header-slick.js"></script>
    <script src="/assets/js/toastify/toastify.js"></script>
    <!-- calendar js-->
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="/assets/js/script.js"></script>
    <script src="/assets/js/script1.js"></script>
    <!-- Plugin used-->
    @yield('js')
</body>

</html>
