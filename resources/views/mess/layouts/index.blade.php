<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Amader Mess</title>
    <link rel="stylesheet" href="{{url('public/lte')}}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{url('public/lte')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="{{url('public/lte')}}/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="{{url('public/lte')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{url('public/lte')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="{{url('public/lte')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="icon" href="{{ url('public/icon.jpg') }}" type="image/jpeg">

    @include('mess.layouts.css')
</head>
<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
<div class="wrapper">
  
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/')}}" class="nav-link">Home</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="{{ memberImage(Auth::user()->id) }}" width="40" height="40" class="rounded-circle" style="margin-top: -10px">
        </a>
        <div class="dropdown-menu" style="margin-left: -115px;margin-top: 5px;" aria-labelledby="navbarDropdownMenuLink">
          <a href="{{ url('myself') }}" class="dropdown-item">
            <i class="fa fa-edit nav-icon"></i>&nbsp;My Information
          </a>
          <a href="{{ url('image') }}" class="dropdown-item">
            <i class="fa fa-image nav-icon"></i>&nbsp;Change Image
          </a>
          <a href="{{ url('change-password') }}" class="dropdown-item">
            <i class="fa fa-edit nav-icon"></i>&nbsp;Change Password
          </a>
          <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item">
            <i class="fa fa-sign-out-alt nav-icon"></i>&nbsp;Log Out
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </a>
          
        </div>
      </li>   
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li> --}}
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('mess.layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Amader Mess</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">Amader Mess</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @include('errors.message')
        @include('tools.modals')
        
        @yield('content')

      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="{{ url('lte/2') }}">Amader Mess</a></strong>
    &nbsp;
    All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<script src="{{url('public/lte')}}/plugins/jquery/jquery.min.js"></script>
<script src="{{url('public/lte')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{url('public/lte')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="{{url('public/lte')}}/dist/js/adminlte.js"></script>
<script src="{{url('public/lte')}}/dist/js/demo.js"></script>
<script src="{{url('public/lte')}}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{url('public/lte')}}/plugins/raphael/raphael.min.js"></script>
<script src="{{url('public/lte')}}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{url('public/lte')}}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<script src="{{url('public/lte')}}/plugins/chart.js/Chart.min.js"></script>
<script src="{{url('public/lte')}}/dist/js/pages/dashboard2.js"></script>

<script src="{{url('public/lte')}}/plugins/select2/js/select2.full.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="{{url('public/lte')}}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{url('public/lte')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="{{url('public/lte')}}/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>

<script type="text/javascript">
  var base_url="{{ url('/') }}";
    $(function () {
        $('.datatable').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true,
        });

        $('#start_date').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
        $('#end_date').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
        $('[data-mask]').inputmask();

        $('.select2').select2()
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        });
    });


    function Show(title,link) {
        $('#modal').modal();
        $('#modal-title').html(title);
        $('#modal-body').html('<h1 class="text-center"><strong>Please wait...</strong></h1>');
        $.ajax({
            url: link,
            type: 'GET',
            data: {},
        })
        .done(function(response) {
            $('#modal-body').html(response);
        });
    }


    function Popup(title,link) {
        $.dialog({
            title: title,
            content: 'url:'+link,
            animation: 'scale',
            columnClass: 'large',
            closeAnimation: 'scale',
            backgroundDismiss: true,
        });
    }

    function SecondShow(title,link) {
        $('#second-modal').modal();
        $('#second-modal-title').html(title);
        $('#second-modal-body').html('<h1 class="text-center"><strong>Please wait...</strong></h1>');
        $.ajax({
            url: link,
            type: 'GET',
            data: {},
        })
        .done(function(response) {
            $('#second-modal-body').html(response);
        });
    }

    function Delete(id,link) {
        $.confirm({
            title: 'Confirm!',
            content: '<hr><div class="alert alert-danger">Are you sure to delete ?</div><hr>',
            buttons: {
                yes: {
                    text: 'Yes',
                    btnClass: 'btn-danger',
                    action: function(){
                        $.ajax({
                            url: link+"/"+id,
                            type: 'DELETE',
                            data: {_token:"{{ csrf_token() }}"},
                        })
                        .done(function(response) {
                            if(response.success){
                                $('#tr-'+id).fadeOut();
                            }else{
                                $.alert({
                                    title: 'Whoops!!',
                                    content: '<hr><div class="alert alert-danger">Something went wrong!</div><hr>',
                                    type: 'red'
                                });
                            }
                        });
                    }
                },
                no: {
                    text: 'No',
                    btnClass: 'btn-default',
                    action: function(){
                        
                    }
                }
            }
        });
            
    }
</script>
</body>
</html>
