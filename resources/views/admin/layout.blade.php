<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>BILLIARD-Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app-light.css') }}">
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/simplebar.css') }}">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/feather.css') }}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app-dark.css') }}" id="darkTheme" disabled>
  </head>
  <body class="vertical  light ">
    <div class="wrapper">
      @include('admin.include.topbar')
      @include('admin.include.sidebar')
      <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              @yield('content')
            </div> <!-- .col-12 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
      </main> <!-- main -->
    </div> <!-- .wrapper -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/moment.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/simplebar.min.js"></script>
    <script src='/assets/js/daterangepicker.js'></script>
    <script src='/assets/js/jquery.stickOnScroll.js'></script>
    <script src="/assets/js/tinycolor-min.js"></script>
    <script src="/assets/js/config.js"></script>
    <script src="/assets/js/d3.min.js"></script>
    <script src="/assets/js/topojson.min.js"></script>
    <script src="/assets/js/datamaps.all.min.js"></script>
    <script src="/assets/js/datamaps-zoomto.js"></script>
    <script src="/assets/js/datamaps.custom.js"></script>
    <script src="/assets/js/Chart.min.js"></script>
    <script>
      /* defind global options */
      Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
      Chart.defaults.global.defaultFontColor = colors.mutedColor;
    </script>
    <script src="/assets/js/gauge.min.js"></script>
    <script src="/assets/js/jquery.sparkline.min.js"></script>
    <script src="/assets/js/apexcharts.min.js"></script>
    <script src="/assets/js/apexcharts.custom.js"></script>
    <script src='/assets/js/jquery.mask.min.js'></script>
    <script src='/assets/js/select2.min.js'></script>
    <script src='/assets/js/jquery.steps.min.js'></script>
    <script src='/assets/js/jquery.validate.min.js'></script>
    <script src='/assets/js/jquery.timepicker.js'></script>
    <script src='/assets/js/dropzone.min.js'></script>
    <script src='/assets/js/uppy.min.js'></script>
    <script src='/assets/js/quill.min.js'></script>
    <script src="/assets/js/apps.js"></script>
    <script>
      $('.select2').select2(
      {
        theme: 'bootstrap4',
      });
      $('.select2-multi').select2(
      {
        multiple: true,
        theme: 'bootstrap4',
      });
    </script>
  </body>
</html>
</body>
</html>