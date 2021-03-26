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
            $('.datatables-demo').dataTable({
                "order": [[ 0, "desc" ]]
            });
        });

        $(".link-ticket-activar").on("click", function(){
            var id = $(this).data('id');
            var resource = 'ticket';
            data = {id:id}
            $.ajax({
                url: '/' + resource + '/' + id,
                type: 'DELETE',  // ticket.destroy
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

        $(".link-ticket-desactivar").on("click", function(){
            var id = $(this).data('id');
            var resource = 'ticket';
            var item = $(this).data(resource);
            bootbox.confirm({
                message:   '¿Confirma que desea desactivar el' + resource + ' <b>'+ item +'</b>?',
                className: 'bootbox-sm',
                callback: function(result) {
                    if(result)
                    {
                        $.ajax({
                            url: '/' + resource + '/' + id,
                            type: 'DELETE',  // ticket.destroy
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
        <span class="text-muted font-weight-light">Mantenedores /</span> Tickets
    </h4>
    <a href="{{ route('ticket.create') }}" class="btn btn-info mb-3" role="button">Crear</a>
    @if(session()->has('message'))
        <div class="alert alert-{{ (session()->get('type') == 'success') ? 'success' : 'danger' }} alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p>{{ session()->get('message') }}</p>
        </div>
    @endif

    <!-- DataTable within card -->
    <div class="card">
        {{-- <h6 class="card-header">tickets</h6> --}}
        <div class="card-datatable table-responsive">
            <table class="datatables-demo table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Proyecto</th>
                        <th>Nombre</th>
                        <th>Solicitante</th>
                        <th>Responsable</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Plazo</th>
                        <th>Usuarios</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr id="tr-{{$item->codigo}}" class="{{ ($item->activo == App\Define::ESTADO_INACTIVO_TEXTO) ? 'tachar' : '' }}">
                            <td>{{ $item->codigo }}</td>
                            <td>{{ $item->proyecto->nombre }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>{{ $item->responsable->nom_usuario }}</td>
                            <td>{{ $item->solicitante->nom_usuario }}</td>
                            <td>{{ ($item->activo == App\Define::ESTADO_ACTIVO_TEXTO) ? 'Activo' : 'Inactivo' }}</td>
                            <td>{{ $item->creacion }}</td>
                            <td>{{ date('Y-m-d', strtotime($item->plazo)) }}</td>
                            <td>
                                @php
                                    if(sizeof($item->usuarios)>0)
                                    {
                                        foreach ($item->usuarios as $usuario) {
                                            echo '<li>' . $usuario->nom_usuario . '</li>';
                                        }
                                    }
                                @endphp
                            </td>
                            <td class="center">
                                <a href="{{ route('ticket.edit', $item->codigo) }}" class="btn btn-sm btn-outline-info" role="button">Editar</a>
                                @if($item->activo == App\Define::ESTADO_ACTIVO_TEXTO)
                                    <a href="#" data-id="{{$item->codigo}}" data-ticket="{{$item->nombre}}" class="btn btn-sm btn-outline-danger link-ticket-desactivar" role="button">Desactivar</a>
                                @else
                                    <a href="#" data-id="{{$item->codigo}}" data-ticket="{{$item->nombre}}" class="btn btn-sm btn-outline-success link-ticket-activar" role="button">Activar</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection