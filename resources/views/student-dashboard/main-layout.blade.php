<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cornelia Connelly College Nise | Admin Dashboard</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/png" href="{{ asset('dashboard-assets/images/favicon.png') }}" />

  <!-- Icon Libraries -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('dashboard-assets/css/styles.min.css') }}" />
  
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
  <!-- Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper"
       data-layout="vertical"
       data-navbarbg="skin6"
       data-sidebartype="full"
       data-sidebar-position="fixed"
       data-header-position="fixed">

    <!-- Sidebar -->
    @include('student-dashboard.partials.sidebar')

    <!-- Main wrapper -->
    <div class="body-wrapper">
      <!-- Header -->
      @include('student-dashboard.partials.header')

      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <!-- Page Body -->
          @include($page)

          <!-- Footer -->
          @include('student-dashboard.partials.footer')
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
  <script src="{{ asset('dashboard-assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('dashboard-assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('dashboard-assets/js/app.min.js') }}"></script>
  <script src="{{ asset('dashboard-assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ asset('dashboard-assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ asset('dashboard-assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

  <!-- Iconify -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

  <!-- CKEditor Initialization -->
  <script>
    // Initialize CKEditor *after* everything has loaded
    let createEditor, editEditor, createBlogEditor, editBlogEditor;

    document.addEventListener("DOMContentLoaded", function() {
      // For Services creation and editing - description
      if (document.querySelector('#serviceDescription')) {
        ClassicEditor.create(document.querySelector('#serviceDescription'))
          .then(editor => createEditor = editor)
          .catch(error => console.error(error));
      }

      if (document.querySelector('#editDescription')) {
        ClassicEditor.create(document.querySelector('#editDescription'))
          .then(editor => editEditor = editor)
          .catch(error => console.error(error));
      }


      // For blog creation and editing - description
      if (document.querySelector('#blogMessage')) {
        ClassicEditor.create(document.querySelector('#blogMessage'))
          .then(editor => createBlogEditor = editor)
          .catch(error => console.error(error));
      }

      if (document.querySelector('#editMessage')) {
        ClassicEditor.create(document.querySelector('#editMessage'))
          .then(editor => editBlogEditor = editor)
          .catch(error => console.error(error));
      }
    });
  </script>

</body>
</html>
