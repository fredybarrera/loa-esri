@extends('layouts.layout-1')

@section('styles')

@endsection

@section('scripts')
    <!-- Dependencies -->
@endsection

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
        Editar proyecto <span class="text-muted">{{ $item->nombre }}</span>
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
    <form method="POST" action="{{ route('proyecto.update', $item->codigo) }}" accept-charset="UTF-8">
        @method('PATCH')
        @csrf
        <div class="card-body pb-2">
            <div class="form-group">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control mb-1" value="{{$item->nombre}}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Descripción</label>
                <input type="text" name="descripcion" class="form-control" value="{{$item->descripcion}}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Tipo de proyecto</label>
                <select name="tipo_proyecto_id" class="custom-select" required>
                    @foreach($tipo_proyectos as $tipo_proyecto)
                        @if($item->tipo_proyecto_id == $tipo_proyecto->id)
                            <option value="{{ $tipo_proyecto->id }}" selected>{{ $tipo_proyecto->nombre }}</option>
                        @else
                            <option value="{{ $tipo_proyecto->id }}" >{{ $tipo_proyecto->nombre }}</option>
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
                
        <div class="text-right mt-3">
            <a href="{{ route('proyecto.index') }}" type="button" class="btn btn-primary" class="btn btn-default">Volver</a>
            <button type="submit" class="btn btn-primary">Guardar</button>&nbsp;
        </div>
    </form>

@endsection