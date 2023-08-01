@extends('adminlte::page')

@section('title', 'Registros medicos')

@section('content_header')
<h1 style="font-weight: bold;text-align: center;">{{ __('Medical record management') }}</h1>
<br><br>
@stop

@section('content')
<div class="content container ">
    <div class="col-sm-12">
        <div class="row justify-content-end">
            <div class="col-sm-5 card px-2 p-2 rounded d-flex align-items-center">
                <div class="col-sm-10 card px-2 p-2 rounded">
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#staticBackdrop"><i class="fas fa-edit"></i> {{ __('Nueva Registro') }}</button>

                </div>
            </div>
        </div>
        <div class="card px-3 p-3 rounded">
            <div class="dataTables_length">
                <table id="tabla" class="table table-striped">

                    <thead>
                        <tr>
                            <th class="text-center">{{ __('NAME_PET') }}</th>
                            <th class="text-center">{{ __('BREED') }}</th>
                            <th class="text-center">{{ __('GENDER') }}</th>
                            <th class="text-center">{{ __('NAME_CUSTOMER') }}</th>
                            <th class="text-center">{{ __('DOCUMENT') }}</th>
                            <th class="text-center">{{ __('DOCUMENT_TYPE') }}</th>
                            <th class="text-center">{{ __('ATTENDED') }}</th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detail as $deta)
                        <tr>
                            <td class="text-center">{{ $deta->pet_name }}</td>
                            <td class="text-center">{{ $deta->breed }}</td>
                            <td class="text-center">{{ $deta->gender }}</td>
                            <td class="text-center">{{ $deta->customer_name }}</td>
                            <td class="text-center">{{ $deta->document }}</td>
                            <td class="text-center">{{ $deta->document_name }}</td>
                            <td class="text-center">{{ $deta->user_name }}</td>
                            <td class="text-center">
                                <a class="btn btn-info btn-sm" href="{{ route('detail_history.show', $deta->id_detail_history) }}"><i class="fas fa-eye" title="Ver más"></i> </a>
                            </td> 
                            <td class="text-center">
                                <?php
                                if ($deta->state_record == 'ACTIVO') {
                                ?>
                                    <form class="formulario-disable" action="{{route('detail_history.delete', $deta->id_detail_history) }}" method="get">
                                        <button class="btn btn-danger btn-sm "><i class="fa fa-trash" aria-hidden="true" title="Eliminar"></i></button>
                                    </form>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal Old-->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="staticBackdropLabel">Nuevo Registro Médico</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="formulario-send_request" action="{{ route('detail_history.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="text-center">
                        <h5>{{ __('OWNER_DATA') }}</h5>
                    </div>
                    <div class="form-group">
                        <label for="asunto">{{ __('DOCUMENT') }}:</label>
                        <input class="p-1 mb-2 bg-white text-dark form-control" style="border: none;outline: none;border-bottom: 2px solid #717171;" required maxlength="45" type="text" id="document_customer" name="document_customer" placeholder="Documento del propietario" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z- 0-9]/,'')" required>
                    </div>
                    <hr>
                    <div class="text-center">
                        <h5>{{ __('PET_DATA') }}</h5>
                    </div>
                    <div class="form-group">
                        <label for="reserva">{{ __('NAME_PET') }}:</label>
                        <input class="p-1 mb-2 bg-white text-dark form-control" style="border: none;outline: none;border-bottom: 2px solid #717171;" required maxlength="45" type="text" id="name_pet" name="name_pet" placeholder="Nombre de la mascota" oninput="this.value = this.value.replace(/[^a-zA-Z- -]/,'')" required>
                    </div>

                    <div class="form-group">
                        <label for="asunto">{{ __('BREED') }}:</label>
                        <input class="p-1 mb-2 bg-white text-dark form-control" style="border: none;outline: none;border-bottom: 2px solid #717171;" required maxlength="45" type="text" id="breed_pet" name="breed_pet" placeholder="Raza de la mascota" oninput="this.value = this.value.replace(/[^a-zA-Z- -]/,'')" required>
                    </div>
                    <div class="form-group">
                        <label for="reserva">{{ __('GENDER') }}:</label>
                        <select style="border-radius:10px;margin: 0% 0% 0% 1%;" class="btn btn-light" aria-label="Default select example" name="type_gender_pet_old" required>
                            <option value="">--Seleccione el genero--</option>
                            <option value="{{ __('FEMALE_PET') }}">{{ __('FEMALE_PET') }}</option>
                            <option value="{{ __('MALE_PET') }}">{{ __('MALE_PET') }}</option>
                        </select>
                    </div>
                    <hr>
                    <div class="text-center">
                        <h5>{{ __('REGISTRATION_DATA') }}</h5>
                    </div>

                    <div class="form-group">
                        <label for="reserva">{{ __('TEMPERATURE') }}:</label>
                        <input class="p-1 mb-2 bg-white text-dark form-control" style="border: none;outline: none;border-bottom: 2px solid #717171;" required maxlength="45" type="text" id="temperature" name="temperature" placeholder="Temperatura" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                    </div>

                    <div class="form-group">
                        <label for="asunto">{{ __('WEIGHT') }}:</label>
                        <input class="p-1 mb-2 bg-white text-dark form-control" style="border: none;outline: none;border-bottom: 2px solid #717171;" required maxlength="45" type="text" id="weight" name="weight" placeholder="Peso" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                    </div>

                    <div class="form-group">
                        <label for="reserva">{{ __('HEART_RATE') }}:</label>
                        <input class="p-1 mb-2 bg-white text-dark form-control" style="border: none;outline: none;border-bottom: 2px solid #717171;" required maxlength="45" type="text" id="heart_rate" name="heart_rate" placeholder="Frecuancia cardiaca" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                    </div>

                    <div class="form-group">
                        <label for="reserva">{{ __('OBSERVATION') }}:</label>
                        <div>
                            <textarea required id="observation" name="observation" type="text" style="width: 100%;height:100%;border:none;border-radius:10px" cols="40" rows="10"></textarea>
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
<!-- FinModal Old-->
@stop


@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('js/datatables.js')}}"></script>

@if(session('save')){
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Registro médico creado!',
        showConfirmButton: false,
        timer: 1500
    }).then(function() {
        document.querySelector('.formulario-send_request').reset();
        localStorage.removeItem('formCache');
    });
</script>
}
@endif

@if(session('error')) {
<script>
    Swal.fire({
        icon: 'error',
        title: 'Lo siento!',
        text: 'El cliente no se encuantra registrado',
        footer: 'Por favor verifique'
    })
</script>
}
@endif

@if(session('not_exist_pet')) {
<script>
    Swal.fire({
        icon: 'error',
        title: 'Lo siento!',
        text: 'La mascota no se encuantra registrado',
        footer: 'Por favor verifique'
    })
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