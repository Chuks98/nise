<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cornellia Connelly College Nise | SalubreTech</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/fav.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/fav.jpg') }}" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

     <!-- For CSRF protection in AJAX requests -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- SEO Optimization Tags -->
  <meta name="description" content="Cornelia Connelly College Nise, Anambra State — nurturing faith, knowledge, and character through quality Catholic education and holistic development.">
  <meta name="keywords" content="Cornelia Connelly College Nise, Catholic school, girls secondary school, Anambra State, education, Holy Child Jesus, Nise school, faith-based education">
  <link rel="canonical" href="{{ url()->current() }}">
  <meta name="author" content="Cornelia Connelly College Nise, Anambra State">
  <meta property="og:title" content="Cornelia Connelly College Nise, Anambra State">
  <meta property="og:description" content="Dedicated to the holistic development of students through academic excellence, spiritual growth, and moral integrity.">
  <meta property="og:image" content="{{ asset('assets/images/slider/Compound_2.jpg') }}">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
</head>

<body>

    <!-- The header -->
    @include('index.partials.header')

    <!-- Dynamic Pages -->
    @include($page)

    <!-- The footer -->
    @include('index.partials.footer')

    <!-- JS Scripts -->
    <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js') }}"></script>
    <script src="{{ asset('assets/plugins/slider/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('dashboard-assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('dashboard-assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

</body>
</html>
