{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>

    </title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />
    <!-- <link href="{{ asset('assets/css/light/loader.css') }}
        rel="stylesheet" type="text/css" /> -->
    <link href="{{ asset('assets/css/light/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/loader.js') }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <!-- <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="{{ asset('assets/css/light/plugins.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <!-- <link href="{{ asset('plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css"> -->
    <link href="{{ asset('assets/css/light/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    {{-- alert --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/light/elements/alert.css') }}">
    {{-- End alert --}}

    {{-- button --}}

    {{-- pagination --}}
    <link href="{{ asset('assets/css/light/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/dark/elements/custom-pagination.css') }}" rel="stylesheet" type="text/css" />
    {{-- End pagination --}}

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    {{ $page_level_style ?? '' }}
</head>

<body class="layout-boxed">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->
    <!--  BEGIN NAVBAR  -->
    <x-navbar />
    <!--  END NAVBAR  -->
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">
        <div class="overlay"></div>
        <div class="search-overlay"></div>
        <!--  BEGIN SIDEBAR  -->

        <x-sidebar />
        <!--  END SIDEBAR  -->
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="middle-content container-xxl p-0">
                    <!--  BEGIN BREADCRUMBS  -->
                    <div class="secondary-nav">
                        <div class="breadcrumbs-container" data-page-heading="Analytics">
                            <header class="header navbar navbar-expand-sm">
                                <a href="javascript:void(0);" class="btn-toggle sidebarCollapse"
                                    data-placement="bottom">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                                        <line x1="3" y1="12" x2="21" y2="12"></line>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <line x1="3" y1="18" x2="21" y2="18"></line>
                                    </svg>
                                </a>
                                <div class="d-flex breadcrumb-content">
                                    <div class="page-header">

                                        <div class="page-title">
                                        </div>

                                        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                            <ol class="breadcrumb">

                                                {{ config('role')[auth()->user()->role] }}
                                                {{-- {{ $page_title ?? 'Dashboard' }} --}}
                                            </ol>
                                        </nav>

                                    </div>
                                </div>



                            </header>
                        </div>
                    </div>
                    <!--  END BREADCRUMBS  -->
                    <!--  BEGIN CONTENT AREA  -->
                    {{ $slot }}
                    <!--  END CONTENT AREA  -->
                </div>
            </div>
            <!--  BEGIN FOOTER  -->
            <x-footer />
            <!--  END FOOTER  -->
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('plugins/src/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('plugins/src/mousetrap/mousetrap.min.js') }}"></script>
    <script src="{{ asset('plugins/src/waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/app.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->



    {{ $page_level_script ?? '' }}

    <script>
        $(".alert.alert-success").fadeTo(5000, 1000).slideUp(500, function() {
            $(".alert").slideUp(500);
        });
        $(".alert.alert-light-success").fadeTo(5000, 1000).slideUp(500, function() {
            $(".alert").slideUp(500);
        });
        $(".alert.alert-light-danger").fadeTo(5000, 1000).slideUp(500, function() {
            $(".alert").slideUp(500);
        });
        $(".alert.alert-danger").fadeTo(5000, 1000).slideUp(500, function() {
            $(".alert").slideUp(500);
        });
    </script>

</body>

</html>
