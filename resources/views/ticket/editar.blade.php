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
@endsection

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
        Editar ticket <br /><span class="text-muted">{{ $item->descripcion }}</span>
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
    <form method="POST" action="{{ route('ticket.update', $item->codigo) }}" accept-charset="UTF-8">
        @method('PATCH')
        @csrf
        <div class="card-body pb-2">
            <div class="form-group">
                <label class="form-label">Nombre</label>
                <input type="text" name="descripcion" class="form-control mb-1" value="{{$item->descripcion}}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Descripción</label>
                <input type="text" name="notas" class="form-control" value="{{$item->notas}}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Proyecto</label>
                <select name="cod_proyecto" class="custom-select" required>
                    @foreach($proyectos as $proyecto)
                        @if($item->cod_proyecto == $proyecto->codigo)
                            <option value="{{ $proyecto->codigo }}" selected>({{ $proyecto->tipoProyecto->nombre }}) - {{ $proyecto->nombre }}</option>
                        @else
                            <option value="{{ $proyecto->codigo }}" >({{ $proyecto->tipoProyecto->nombre }}) - {{ $proyecto->nombre }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Usuario solicitante</label>
                <select name="cod_usuario_sol" class="custom-select" required>
                    @foreach($usuarios as $usuario)
                        @if($item->cod_usuario_sol == $usuario->codigo)
                            <option value="{{ $usuario->codigo }}" selected>{{ $usuario->nombres }} {{ $usuario->apellidos }}</option>
                        @else
                            <option value="{{ $usuario->codigo }}" >{{ $usuario->nombres }} {{ $usuario->apellidos }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Usuario responsable</label>
                <select name="cod_usuario_res" class="custom-select" required>
                    @foreach($usuarios as $usuario)
                        @if($item->cod_usuario_res == $usuario->codigo)
                            <option value="{{ $usuario->codigo }}" selected>{{ $usuario->nombres }} {{ $usuario->apellidos }}</option>
                        @else
                            <option value="{{ $usuario->codigo }}" >{{ $usuario->nombres }} {{ $usuario->apellidos }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Estado</label>
                <select name="activo" class="custom-select" required>
                    @foreach($estados as $key => $value)
                        @if($item->activo == $key)
                            <option value="{{ $key }}" selected>{{ $value }}</option>
                        @else
                            <option value="{{ $key }}" >{{ $value }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Fecha plazo</label>
                <input type="date" name="plazo" class="form-control" value="{{ date('Y-m-d', strtotime($item->plazo)) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Tickets</label>
                <select id="sel_ticket_usuarios_editar" name="usuario_id[]" class="selectpicker" title="Seleccione uno o mas usuarios..." data-style="btn-default" multiple data-icon-base="ion" data-live-search="true" data-tick-icon="ion-md-checkmark" data-selected-text-format="count > 4" data-size="6" data-actions-box="true">
                    @foreach ($usuarios as $usuario)
                        @if(in_array($usuario->codigo, $tickets_user))
                            <option value="{{ $usuario->codigo }}" selected="true">{{ $usuario->nombres }} {{ $usuario->apellidos }}</option>
                        @else
                            <option value="{{$usuario->codigo}}">{{ $usuario->nombres }} {{ $usuario->apellidos }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="text-right mt-3">
            <a href="{{ route('ticket.index') }}" type="button" class="btn btn-primary" class="btn btn-default">Volver</a>
            <button type="submit" class="btn btn-primary">Guardar</button>&nbsp;
        </div>
    </form>

@endsection