@extends('layouts.layout-blank')

@section('styles')
    <!-- Page -->
    <link rel="stylesheet" href="{{ mix('/vendor/css/pages/authentication.css') }}">
@endsection

@section('content')
    <div class="authentication-wrapper authentication-2 ui-bg-cover ui-bg-overlay-container px-4" style="background-image: url('/images/bg/2.png');">
        <div class="ui-bg-overlay bg-dark opacity-25"></div>
        <div class="authentication-inner py-5">
            <div class="card">
                <div class="p-4 p-sm-5">
                    <!-- Logo -->
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="">
                            <div class="position-relative">
                                <img src="/images/esri_logo.jpg" class="col" alt>
                            </div>
                        </div>
                    </div>
                    <!-- / Logo -->

                    <h5 class="text-center text-muted font-weight-normal mb-4">Perfiles disponibles</h5>

                    <!-- Form -->
                    <div class="panel-body forms">
                        <form id="form-escoger-perfil" method="POST" action="{{ url('/setPerfil') }}">
                            {{ csrf_field() }}
                            <fieldset class="form-group">
                                <div class="row">
                                    <div class="col-sm-10 offset-2">
                                        <div class="custom-controls-stacked">
                                            @foreach($perfiles as $perfil)
                                                <label class="custom-control custom-radio">
                                                    <input type="radio" name="perfil_id" value="{{ $perfil->id }}" class="custom-control-input">
                                                    <span class="custom-control-label">{{ $perfil->nombre }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-sm-10 ml-sm-auto">
                                    <button type="button" id="btn-login-perfil" class="btn btn-primary">Aceptar</button>
                                </div>
                            </div>
                        </form>
                        <div id="message-login" class="alert alert-dark-danger alert-dismissible fade show" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            Debe escoger un perfil de usuario.
                        </div>
                    </div>
                    <!-- / Form -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
            $("#btn-login-perfil").on("click", function(){
                if($('input[name=perfil_id]:checked').length <=0)
                {
                    $("#message-login").show();
                }else{
                    $( "#form-escoger-perfil" ).submit();
                    $("#message-login").hide();
                }
            });
    </script>
@endsection