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

        $(".link-user-activar").on("click", function(){
            var id = $(this).data('id');
            var usuario = $(this).data('usuario');
            var resource = 'usuario';
            data = {id:id}
            $.ajax({
                url: 'activar-usuario',
                data: data,
                type: 'POST',
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


        $(".link-user-desactivar").on("click", function(){
            var id = $(this).data('id');
            var usuario = $(this).data('usuario');
            var resource = 'usuario';
            bootbox.confirm({
                message:   '¿Confirma que desea desactivar al usuario <b>'+ usuario +'</b>?',
                className: 'bootbox-sm',
                callback: function(result) {
                    if(result)
                    {
                        $.ajax({
                            url: '/' + resource + '/' + id,
                            type: 'DELETE',  // user.destroy
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
    <h4 class="font-weight-bold py-3 mb-4">
        <span class="text-muted font-weight-light">Mantenedores /</span> Usuarios
    </h4>
    <!-- DataTable within card -->
    <div class="card">
        {{-- <h6 class="card-header">Usuarios</h6> --}}
        <div class="card-datatable table-responsive">
            <table class="datatables-demo table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Nombre de usuario</th>
                        <th>Correo</th>
                        <th>Estado</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr id="tr-{{$item->id}}" class="{{ ($item->estado == App\Define::ESTADO_INACTIVO) ? 'tachar' : '' }}">
                            <td>{{ $item->apellidos }}</td>
                            <td>{{ $item->nombres }}</td>
                            <td>{{ $item->nom_usuario }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ ($item->estado == App\Define::ESTADO_ACTIVO) ? 'Activo' : 'Inactivo' }}</td>
                            <td class="center">
                                <a href="{{ route('usuario.edit', $item->id) }}" class="btn btn-sm btn-outline-info" role="button">Editar</a>
                                @if($item->estado == App\Define::ESTADO_ACTIVO)
                                    <a href="#" data-id="{{$item->id}}" data-usuario="{{$item->nom_usuario}}" class="btn btn-sm btn-outline-danger link-user-desactivar" role="button">Desactivar</a>
                                @else
                                    <a href="#" data-id="{{$item->id}}" data-usuario="{{$item->nom_usuario}}" class="btn btn-sm btn-outline-success link-user-activar" role="button">Activar</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection