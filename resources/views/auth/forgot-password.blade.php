<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css"/>

</head>

<body class="bg-primary bg-pattern">
<div class="home-btn d-none d-sm-block">
    <a href="{{url('/')}}"><i class="mdi mdi-home-variant h2 text-white"></i></a>
</div>

<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mb-5">
                    <a href="index.html" class="logo"><img src="assets/images/logo-light.png" height="24"
                                                           alt="logo"></a>
                    <h5 class="font-size-16 text-white-50 mb-4">Manage your Global Auction Platform Lots</h5>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-xl-5 col-sm-8">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="p-2">
                            <h5 class="mb-3 text-center">Reset Password</h5>
                            <form method="POST" class="form-horizontal" action="{{ route('password.email') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-warning">
                                            Enter your <b>Email</b> and instructions will be sent to you!
                                        </div>

                                        <div class="form-group form-group-custom mt-4">
                                            <input type="email" class="form-control" id="useremail" name="email"
                                                   value="{{old('email')}}">
                                            <label for="useremail">Email</label>
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn btn-success btn-block waves-effect waves-light"
                                                    type="submit">Send Email
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</div>
<!-- end Account pages -->

<!-- JAVASCRIPT -->
<script src={{asset("assets/libs/jquery/jquery.min.js")}}></script>
<script src={{asset("assets/libs/bootstrap/js/bootstrap.bundle.min.js")}}></script>
<script src={{asset("assets/libs/metismenu/metisMenu.min.js")}}></script>
<script src={{asset("assets/libs/simplebar/simplebar.min.js")}}></script>
<script src={{asset("assets/libs/node-waves/waves.min.js")}}></script>

<script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>


<script src={{asset("assets/js/app.js")}}></script>

</body>
</html>
