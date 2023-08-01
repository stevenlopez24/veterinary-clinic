@extends('adminlte::page')

@section('title', 'Detalle médico')

@section('content_header')
<h1 style="font-weight: bold;text-align: center;">{{ __('MEDICAL_RECORD_DETAILS') }}</h1>
<br><br>
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
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop"><i class="fas fa-edit"></i>{{ __('Edit') }}</button>
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
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="staticBackdropLabel">{{ __('REGISTRY_EDIT') }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="formulario-send_request" action="{{ route('detail_history.update', $detail->id_detail_history) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="text-center">
                        <h5>{{ __('REGISTRATION_DATA') }}</h5>
                    </div>

                    <div class="form-group">
                        <label for="reserva">{{ __('TEMPERATURE') }}:</label>
                        <input class="p-1 mb-2 bg-white text-dark form-control" value="{{ $detail->temperature }}" style="border: none;outline: none;border-bottom: 2px solid #717171;" required maxlength="45" type="text" id="temperature" name="temperature" placeholder="Temperatura" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                    </div>

                    <div class="form-group">
                        <label for="asunto">{{ __('WEIGHT') }}:</label>
                        <input class="p-1 mb-2 bg-white text-dark form-control" value="{{ $detail->weight }}" style="border: none;outline: none;border-bottom: 2px solid #717171;" required maxlength="45" type="text" id="weight" name="weight" placeholder="Peso" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                    </div>

                    <div class="form-group">
                        <label for="reserva">{{ __('HEART_RATE') }}:</label>
                        <input class="p-1 mb-2 bg-white text-dark form-control" value="{{ $detail->heart_rate }}" style="border: none;outline: none;border-bottom: 2px solid #717171;" required maxlength="45" type="text" id="heart_rate" name="heart_rate" placeholder="Frecuancia cardiaca" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                    </div>

                    <div class="form-group">
                        <label for="reserva">{{ __('OBSERVATION') }}:</label>
                        <div>
                            <textarea required id="observation" name="observation" type="text" style="width: 100%;height:100%;border:none;border-radius:10px" cols="40" rows="10">{{ $detail->observation }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Return') }}</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save "></i> {{ __('SAVE') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- FinModal -->
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('update')){
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Registro médico modificado!',
        showConfirmButton: false,
        timer: 1500
    }).then(function() {
        document.querySelector('.formulario-send_request').reset();
        localStorage.removeItem('formCache');
    });
</script>
}
@endif

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
</script>
@stop