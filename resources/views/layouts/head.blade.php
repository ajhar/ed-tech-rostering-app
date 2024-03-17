<head>
    <meta charset="utf-8"/>
    <title>Ed-Tech Rostering</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" content="{{csrf_token()}}">
    <meta name="base_url" content="{{url('/')}}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- DataTables -->
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>

    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- alertifyjs Css -->
    <link href="{{asset('assets/libs/alertifyjs/build/css/alertify.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Selectize -->
    <link href="{{asset('assets/libs/selectize/css/selectize.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('assets/app/css/loader.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/app/css/validation.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/app/css/ed-tech-rostering-app.css')}}" rel="stylesheet" type="text/css"/>
    @stack('css')
</head>
