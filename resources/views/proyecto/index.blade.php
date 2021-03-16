@extends('layouts.layout-1')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/toastr/toastr.css') }}">
    <style>
        .tachar {
            text-decoration:line-through;
            color: red;
        }
    </style>
@endsection

@section('scripts')
    <!-- Dependencies -->
    <script src="{{ mix('/vendor/libs/datatables/datatables.js') }}"></script>
    <script src="{{ mix('/vendor/libs/bootbox/bootbox.js') }}"></script>
    <script src="{{ mix('/vendor/libs/toastr/toastr.js') }}"></script>
    
    <!-- Javascript -->
    <script>
        $(function() {
            $('.datatables-demo').dataTable();
        });

        $(".link-proyecto-activar").on("click", function(){
            var id = $(this).data('id');
            var resource = 'proyecto';
            data = {id:id}
            $.ajax({
                url: '/' + resource + '/' + id,
                type: 'DELETE',  // proyecto.destroy
                success: function(response) {
                    toastr['success'](resource + ' activado con éxito!', 'Confirmación', {
                        positionClass: 'toast-top-right',
                        closeButton: true,
                        progressBar: true,
                        rtl: $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl'
                    });
                    location.reload();
                }
            });
        });


        $(".link-proyecto-desactivar").on("click", function(){
            var id = $(this).data('id');
            var resource = 'proyecto';
            var item = $(this).data(resource);
            bootbox.confirm({
                message:   '¿Confirma que desea desactivar el' + resource + ' <b>'+ item +'</b>?',
                className: 'bootbox-sm',
                callback: function(result) {
                    if(result)
                    {
                        $.ajax({
                            url: '/' + resource + '/' + id,
                            type: 'DELETE',  // proyecto.destroy
                            success: function(response) {
                                toastr['success'](resource + ' desactivado con éxito!', 'Confirmación', {
                                    positionClass: 'toast-top-right',
                                    closeButton: true,
                                    progressBar: true,
                                    rtl: $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl'
                                });
                                location.reload();
                            }
                        });
                    }
                },
            });
        });
        
    </script>
@endsection

@section('content')
    <h4 class="font-weight-bold py-3 mb-1">
        <span class="text-muted font-weight-light">Mantenedores /</span> Iniciativas
    </h4>
    <a href="{{ route('proyecto.create') }}" class="btn btn-info mb-3" role="button">Crear</a>

    <!-- DataTable within card -->
    <div class="card">
        {{-- <h6 class="card-header">Proyectos</h6> --}}
        <div class="card-datatable table-responsive">
            <table class="datatables-demo table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Tipo proyecto</th>
                        <th>Usuario responsable</th>
                        <th>Estado</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr id="tr-{{$item->codigo}}" class="{{ ($item->estado == App\Define::ESTADO_INACTIVO) ? 'tachar' : '' }}">
                            <td>{{ $item->codigo }}</td>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>{{ $item->tipoProyecto->nombre }}</td>
                            <td>{{ $item->usuario->nombres }} {{ $item->usuario->apellidos }}</td>
                            <td>{{ ($item->estado == App\Define::ESTADO_ACTIVO) ? 'Activo' : 'Inactivo' }}</td>
                            <td class="center">
                                <a href="{{ route('proyecto.edit', $item->codigo) }}" class="btn btn-sm btn-outline-info" role="button">Editar</a>
                                @if($item->estado == App\Define::ESTADO_ACTIVO)
                                    <a href="#" data-id="{{$item->codigo}}" data-proyecto="{{$item->nombre}}" class="btn btn-sm btn-outline-danger link-proyecto-desactivar" role="button">Desactivar</a>
                                @else
                                    <a href="#" data-id="{{$item->codigo}}" data-proyecto="{{$item->nombre}}" class="btn btn-sm btn-outline-success link-proyecto-activar" role="button">Activar</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection