@extends('layouts.layout-1')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/bootstrap-select/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    
    <!-- Page -->
    <link rel="stylesheet" href="{{ mix('/vendor/css/pages/users.css') }}">
@endsection

@section('scripts')
    <!-- Dependencies -->
    <script src="{{ mix('/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ mix('/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ mix('/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
    
    <script>
        $(function() {
            $('.user-edit-multiselect').each(function() {
            $(this)
                .wrap('<div class="position-relative"></div>')
                .select2({
                dropdownParent: $(this).parent()
                });
            });

            $('.user-edit-tagsinput').tagsinput({ tagClass: 'badge badge-default' });

        });
    </script>
@endsection

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
        Editar usuario <br /><span class="text-muted">{{ $item->nombres }} {{ $item->apellidos }}</span>
    </h4>
    @if(session()->has('message'))
        <div class="alert alert-{{ (session()->get('type') == 'success') ? 'success' : 'danger' }} alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p>{{ session()->get('message') }}</p>
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            Por favor corrige los siguientes errores:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('usuario.update', $item->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="nav-tabs-top">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#user-edit-account">Información personal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#user-edit-info">Configuración</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="user-edit-account">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <img src="/images/avatars/{{ $item->foto }}" alt="" class="d-block ui-w-80">
                            <div class="media-body ml-3">
                                <label class="form-label d-block mb-2">Avatar</label>
                                {{-- <label class="btn btn-outline-primary btn-sm">Change<input type="file" class="user-edit-fileinput"></label>&nbsp;
                                <button type="button" class="btn btn-default btn-sm md-btn-flat">Reset</button> --}}
                            </div>
                        </div>
                    </div>
                    <hr class="border-light m-0">
                    <div class="card-body pb-2">
                        <div class="form-group">
                            <label class="form-label">Nombres</label>
                            <input type="text" name="nombres" class="form-control mb-1" value="{{$item->nombres}}" required>
                            {{-- <a href="javascript:void(0)" class="small">Reset password</a> --}}
                        </div>
                        <div class="form-group">
                            <label class="form-label">Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" value="{{$item->apellidos}}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nombre de usuario</label>
                            <input type="text" name="nom_usuario" class="form-control" value="{{$item->nom_usuario}}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">E-mail</label>
                            <input type="email" name="email" class="form-control mb-1" value="{{$item->email}}" required>
                            {{-- <a href="javascript:void(0)" class="small">Resend confirmation</a> --}}
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control mb-1 is-valid" value="">
                            <span class="valid-feedback">Dejar en blanco si no la desea cambiar.</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirmación de password</label>
                            <input type="password" name="password_confirmation" class="form-control mb-1 is-valid" value="">
                            <span class="valid-feedback">Dejar en blanco si no la desea cambiar.</span>
                        </div>
                    {{-- <hr class="border-light m-0"> --}}
                        <div class="form-group">
                            <label class="form-label">Estado</label>
                            <select name="estado" class="custom-select" required>
                                @foreach($estados as $key => $value)
                                    @if($item->estado == $key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}" >{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="user-edit-info">
                    <div class="card-body pb-2">
                        <div class="form-group">
                            <label class="form-label">Perfiles</label>
                            <select id="sel_perfil_usuario_editar" name="perfil_id[]" multiple class="user-edit-multiselect form-control w-100">
                                @foreach ($perfiles as $perfil)
                                    @if(in_array($perfil->id, $user_perfiles))
                                        <option value="{{ $perfil->id }}" selected="true">{{ $perfil->nombre }}</option>
                                    @else
                                        <option value="{{$perfil->id}}">{{$perfil->nombre}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tickets</label>
                            <select id="sel_ticket_usuario_editar" name="ticket_id[]" class="selectpicker" title="Seleccione uno o mas tickets..." data-style="btn-default" multiple data-icon-base="ion" data-live-search="true" data-tick-icon="ion-md-checkmark" data-selected-text-format="count > 3" data-size="6" data-actions-box="true">
                                @foreach ($tickets as $ticket)
                                    @if(in_array($ticket->codigo, $user_tickets))
                                        <option value="{{ $ticket->codigo }}" selected="true">{{ $ticket->descripcion }}</option>
                                    @else
                                        <option value="{{$ticket->codigo}}">{{$ticket->descripcion}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mt-3">
            <a href="{{ route('usuario.index') }}" type="button" class="btn btn-primary" class="btn btn-default">Volver</a>
            <button type="submit" class="btn btn-primary">Guardar</button>&nbsp;
        </div>
    </form>

@endsection