@extends('adminlte::page')

@section('title', 'Detalle médico')

@section('content_header')
<h1>{{ __('MEDICAL_RECORD_DETAILS') }}</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h5>{{ __('OWNER_DATA') }}</h5>
                    </div>
                    <div class="form-group">
                        <label>{{ __('NAME_CUSTOMER') }}:</label>
                        <span>{{ $detail->customer_name }}</span><br>

                        <label>{{ __('GENDER') }}:</label>
                        <span>{{ $detail->customer_gender }}</span><br>

                        <label>{{ __('DOCUMENT') }}:</label>
                        <span>{{ $detail->document }}</span><br>

                        <label>{{ __('DOCUMENT_TYPE') }}:</label>
                        <span>{{ $detail->document_name }}</span><br>
                    </div>
                    <hr>
                    <div class="text-center">
                        <h5>{{ __('PET_DATA') }}</h5>
                    </div>
                    <div class="form-group">
                        <label>{{ __('NAME_PET') }}:</label>
                        <span>{{ $detail->pet_name }}</span><br>

                        <label>{{ __('BREED') }}:</label>
                        <span>{{ $detail->breed }}</span><br>

                        <label>{{ __('GENDER') }}:</label>
                        <span>{{ $detail->pet_gender }}</span><br>
                    </div>
                    <hr>
                    <div class="text-center">
                        <h5>{{ __('RECORD') }}</h5>
                    </div>
                    <div class="form-group">
                        <label>{{ __('TEMPERATURE') }}:</label>
                        <span>{{ $detail->temperature }} C°</span><br>

                        <label>{{ __('WEIGHT') }}:</label>
                        <span>{{ $detail->weight }} Kg</span><br>

                        <label>{{ __('HEART_RATE') }}:</label>
                        <span>{{ $detail->heart_rate }} lpm</span><br>

                        <label>{{ __('OBSERVATION') }}:</label>
                        <div>                        
                            <textarea readonly="readonly" type="text" style="width: 100%;height:100%;border:none;border-radius:10px" cols="40" rows="10">{{ $detail->observation }}</textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>{{ __('CREATE_TIME') }}:</label>
                        <span>{{ $detail->create_time }}</span><br>

                        <label>{{ __('UPDATE_TIME') }}:</label>
                        <span>{{ $detail->update_time }}</span><br>

                        <label>{{ __('STATE_RECORD') }}:</label>
                        <span>{{ $detail->state_record }}</span>
                    </div>
                    <hr>
                    <div class="row mb-12 justify-content-end">
                        <div class="row-mb-10">
                            <?php
                            if ($detail->state_record == 'ACTIVO') {
                            ?>
                                <form class="formulario-disable" action="{{ route('detail_history.delete', $detail->id_detail_history) }}" method="GET">
                                    <button class="btn btn-danger mr-1"><i class="fa fa-trash" aria-hidden="true"></i> {{ __('Disable') }}</button>
                                </form>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="row-mb-2">
                            <a href="{{ route('detail_history.index') }}" class="btn btn-success"><i class="fas fa-edit"></i> {{ __('Edit') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 text-left">
                <a href="{{ route('detail_history.index') }}" class="btn btn-primary"><i class="fas fa-undo-alt"></i> {{ __('Return') }}</a>
            </div><br><br>
        </div>
    </div>
</div>
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('.formulario-disable').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Esta seguro de eliminar el registro?',
            text: "Esto eliminara el registro de la mascota!",
            icon: 'warning',
            showDenyButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Eliminar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            } else if (result.isDenied) {
                Swal.fire('No se elimino el registro!!', '', 'info')
            }
        })
    })


    $('.formulario-state').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Esta seguro de actualizar la reserva?',
            showDenyButton: true,
            confirmButtonText: 'Actualizar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            } else if (result.isDenied) {
                Swal.fire('No se actualizó la reserva!!', '', 'info')
            }
        })
    })
</script>
@stop