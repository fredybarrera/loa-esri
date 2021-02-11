@extends('layouts.layout-1')

@section('content')
    {{-- <h4 class="font-weight-bold py-3 mb-4">Home profesional</h4> --}}
    <!-- Stats -->
    <div class="card mb-4 mt-4" style="padding: 20px; 0px;">
        <h6 class="card-header with-elements">
            <div class="card-header-title">Mis iniciativas</div>
        </h6>
        <div class="row">
            @foreach($tickets as $ticket)
                <div class="col-sm-3">
                    <div class="card mb-2 mt-2">
                        <div class="card-header border-0 pb-0">{{$ticket->descripcion}}</div>
                        <div class="card-body text-center text-success text-xlarge py-3">{{rtrim(rtrim(number_format($ticket->horas,1,",","."),0),',')}} horas</div>
                        <div class="card-footer border-0 small pt-0">
                            <div class="card-subtitle text-muted mb-1 mt-1">{{$ticket->proyecto}}</div>
                            {{-- <div class="float-right text-success">
                                <small class="ion ion-md-arrow-round-up"></small> 11.25%
                            </div>
                            <span class="text-muted">Total: 46,536</span> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- / Stats -->
@endsection
