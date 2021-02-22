@extends('layouts.layout-1')

@section('content')
    {{-- <h4 class="font-weight-bold py-3 mb-4">Home profesional</h4> --}}
    <!-- Stats -->
    <div class="card mb-4 mt-4" style="padding: 20px; 0px;">
        <h6 class="card-header with-elements">
            <div class="card-header-title">Equipos</div>
        </h6>
        <div class="row">
            @foreach($proyectos as $proyecto)
                <div class="col-sm-6 col-xl-4">
                    <div class="card mb-4">
                        <div class="card-body pb-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <a href="javascript:void(0)" class="text-body text-big font-weight-semibold">{{$proyecto->proyecto}}</a>
                                    <span class="badge badge-success align-text-bottom ml-1">{{ ($proyecto->estado == 'S')?'Activo':'Inactivo' }}</span>
                                </div>
                                <div class="btn-group team-actions">
                                    <button type="button" class="btn btn-sm btn-default icon-btn borderless rounded-pill md-btn-flat dropdown-toggle hide-arrow" data-toggle="dropdown">
                                        <i class="ion ion-ios-more"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0)">Ver</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Editar</a>
                                        {{-- 
                                        <a class="dropdown-item" href="javascript:void(0)">Remove</a> 
                                        --}}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                {{ $proyecto->notas }}
                            </div>
                        </div>
                        <div class="card-body pt-3 pb-0">
                            <div class="text-muted small mb-2">Responsable</div>
                            <div class="d-flex flex-wrap">
                                <a href="javascript:void(0)" class="d-block mr-1 mb-1"><img src="/images/avatars/{{ $proyecto->foto }}" alt="" class="ui-w-30 rounded-circle" data-toggle="tooltip" data-placement="top" data-state="dark" title="{{ $proyecto->responsable_proyecto }}"></a>
                            </div>
                        </div>
                        <div class="card-body py-3">
                            <div class="text-muted small mb-2">Equipo</div>
                            <div class="d-flex flex-wrap">
                                @php
                                    $miembros = explode(" , ", $proyecto->miembros);
                                    foreach ($miembros as $value) {
                                        $aux = explode(" - ", $value);
                                        $nombre = $aux[0];
                                        $foto = $aux[1];
                                        echo '<a href="javascript:void(0)" class="d-block mr-1 mb-1"><img src="/images/avatars/'.$foto.'" alt="" data-toggle="tooltip" data-placement="top" data-state="primary" class="ui-w-30 rounded-circle" title="'.$nombre.'"></a>';
                                    }
                                @endphp
                            </div>
                        </div>
                        <hr class="m-0">
                        <div class="card-body">
                            <div class="text-muted small">Iniciativa</div>
                            <div class="mb-3"><a href="javascript:void(0)" class="text-body font-weight-semibold">{{ $proyecto->iniciativa }}</a></div>
                            <div class="d-flex justify-content-between align-items-center small">
                                <div class="font-weight-bold">50%</div>
                                <div class="text-muted">10 / 20 tareas completadas</div>
                            </div>
                            <div class="progress mt-1" style="height: 3px;">
                                <div class="progress-bar" style="width: 50%;"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <div class="text-muted small">Fecha inicio</div>
                                    <div class="small font-weight-bold">{{ date('Y-m-d', strtotime($proyecto->creacion)) }}</div>
                                </div>
                                <div class="col">
                                    <div class="text-muted small">Fecha de término</div>
                                    <div class="small font-weight-bold">{{ date('Y-m-d', strtotime($proyecto->plazo)) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- / Stats -->
@endsection
@section('scripts')
    <!-- Javascript -->
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <!-- / Javascript -->
@endsection
