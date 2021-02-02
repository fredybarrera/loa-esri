@extends('layouts.layout-1')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    
    <!-- Page -->
    <link rel="stylesheet" href="{{ mix('/vendor/css/pages/users.css') }}">
@endsection

@section('scripts')
    <!-- Dependencies -->
    <script src="{{ mix('/vendor/libs/select2/select2.js') }}"></script>
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
        Editar usuario <span class="text-muted">{{ $item->nom_usuario }}</span>
    </h4>

    <div class="nav-tabs-top">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#user-edit-account">Información personal</a>
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
                        <input type="text" class="form-control mb-1" value="{{$item->nombres}}">
                        {{-- <a href="javascript:void(0)" class="small">Reset password</a> --}}
                    </div>
                    <div class="form-group">
                        <label class="form-label">Apellidos</label>
                        <input type="text" class="form-control" value="{{$item->apellidos}}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">E-mail</label>
                        <input type="text" class="form-control mb-1" value="{{$item->email}}">
                        {{-- <a href="javascript:void(0)" class="small">Resend confirmation</a> --}}
                    </div>
                </div>
                <hr class="border-light m-0">
                <div class="card-body pb-2">
                    <div class="form-group">
                        <label class="form-label">Estado</label>
                        <select class="custom-select">
                            <option value="1" {{ ($item->estado == App\Define::ESTADO_ACTIVO) ? 'selected' : '' }}>Activo</option>
                            <option value="-1" {{ ($item->estado == App\Define::ESTADO_INACTIVO) ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Perfiles</label>
                        <select multiple class="user-edit-multiselect form-control w-100">
                            @foreach ($perfiles as $perfil)
                                <option value="{{$perfil->id}}">{{$perfil->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-right mt-3">
        <button type="button" class="btn btn-primary">Guardar</button>&nbsp;
    </div>
@endsection