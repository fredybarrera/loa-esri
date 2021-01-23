@extends('layouts.layout-blank')

@section('styles')
    <!-- Page -->
    <link rel="stylesheet" href="{{ mix('/vendor/css/pages/authentication.css') }}">
@endsection

@section('content')
    <div class="authentication-wrapper authentication-3">
        <div class="authentication-inner">

            <!-- Side container -->
            <!-- Do not display the container on extra small, small and medium screens -->
            <div class="d-none d-lg-flex col-lg-8 align-items-center ui-bg-cover ui-bg-overlay-container p-5" style="background-image: url('/images/bg/1.jpg');">
                <div class="ui-bg-overlay bg-dark opacity-50"></div>

                <!-- Text -->
                <div class="w-100 text-white px-5">
                    <h1 class="display-2 font-weight-bolder mb-4"></h1>
                    <div class="text-large font-weight-light"></div>
                </div>
                <!-- /.Text -->
            </div>
            <!-- / Side container -->

            <!-- Form container -->
            <div class="d-flex col-lg-4 align-items-center theme-bg-white p-5">
                <!-- Inner container -->
                <!-- Have to add `.d-flex` to control width via `.col-*` classes -->
                <div class="d-flex col-sm-7 col-md-5 col-lg-12 px-0 px-xl-4 mx-auto">
                    <div class="w-100">

                        <!-- Logo -->
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="ui-w-120">
                                <div class="w-100 position-relative">
                                    <img src="/images/esri_logo.jpg" class="d-block ui-w-140 rounded-circle" alt>
                                </div>
                            </div>
                        </div>
                        <!-- / Logo -->

                        <h4 class="text-center text-lighter font-weight-normal mt-5 mb-0">Login LOA</h4>

                        <!-- Form -->
                        <form class="my-5">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label d-flex justify-content-between align-items-end">
                                    <div>Password</div>
                                    <!-- <a href="javascript:void(0)" class="d-block small">Forgot password?</a> -->
                                </label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="d-flex justify-content-between align-items-center m-0">
                                <!-- <label class="custom-control custom-checkbox m-0">
                                    <input type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label">Remember me</span>
                                </label> -->
                                <button type="button" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                        <!-- / Form -->

                        <!-- <div class="text-center text-muted">
                            Don't have an account yet? <a href="javascript:void(0)">Sign Up</a>
                        </div> -->

                    </div>
                </div>
            </div>
            <!-- / Form container -->

        </div>
    </div>
@endsection