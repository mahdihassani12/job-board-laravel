<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Job Board</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/frontend/img/favicon.png') }}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/gijgo.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/summernote-bs4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('public/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/select2.min.css') }}">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
     @yield('style')
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    @include('frontend.partials.header')

    <main>
        @include('frontend.messages.flash_messages')
        
        @yield('main_content')

    </main>

    @include('frontend.partials.footer')
    <!-- link that opens popup -->
    <!-- JS here -->
    <script src="{{ asset('public/frontend/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/ajax-form.js') }}"></script>
    <script src="{{ asset('public/frontend/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/scrollIt.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins.js') }}"></script>
    <script src="{{ asset('public/frontend/js/gijgo.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/summernote-bs4.min.js') }}"></script>

    <!--contact js-->
    <script src="{{ asset('public/frontend/js/contact.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.form.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/mail-script.js') }}"></script>

    <script src="{{ asset('public/frontend/js/main.js') }}"></script>
    <script src="{{ asset('public/frontend/js/select2.min.js') }}"></script>
    @yield('script')
</body>