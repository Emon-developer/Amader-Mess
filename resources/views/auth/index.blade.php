<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{url('public/lte')}}/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{url('public/lte')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="{{url('public/lte')}}/dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page" style="background-image: url('{{ url('public/img/mess.jpg') }}');background-repeat: no-repeat;background-size: 100% 100%;">

<div class="container">
  <div class="row">
    @yield('content')
  </div>
</div>

<script src="{{url('public/lte')}}/plugins/jquery/jquery.min.js"></script>
<script src="{{url('public/lte')}}/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script src="{{url('public/lte')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{url('public/lte')}}/dist/js/adminlte.min.js"></script>
<script>
  $(function () {
    $('#mess_from').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
    $('[data-mask]').inputmask()
  })
</script>
</body>
</html>
