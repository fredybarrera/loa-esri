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

        });
    </script>
@endsection

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
        Crear proyecto
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
    <form method="POST" action="{{ route('proyecto.store') }}" accept-charset="UTF-8">
        @csrf
        <div class="card-body pb-2">
            <div class="form-group">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control mb-1" value="{{ old('nombre') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Descripción</label>
                <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Tipo de proyecto</label>
                <select name="tipo_proyecto_id" class="custom-select" required>
                    @foreach($tipo_proyectos as $tipo_proyecto)
                        <option value="{{ $tipo_proyecto->id }}" >{{ $tipo_proyecto->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Usuario responsable</label>
                <select name="cod_usuario_res" class="custom-select" required>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->codigo }}" >{{ $usuario->nombres }} {{ $usuario->apellidos }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Estado</label>
                <select name="estado" class="custom-select" required>
                    @foreach($estados as $key => $value)
                        <option value="{{ $key }}" >{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="text-right mt-3">
            <a href="{{ route('proyecto.index') }}" type="button" class="btn btn-primary" class="btn btn-default">Volver</a>
            <button type="submit" class="btn btn-primary">Guardar</button>&nbsp;
        </div>
    </form>

@endsection