@extends('adminlte::page')

@section('title', 'Mascotas')

@section('content_header')
<h1 style="font-weight: bold;text-align: center;">{{ __('MEDICAL_RECORD_MANAGEMENT') }}</h1>
<br><br>
@stop

@section('content')
<div class="content container ">
    <div class="col-sm-12">
        <div class="row justify-content-end">
            <div class="col-sm-5 card px-2 p-2 rounded d-flex align-items-center">
                <div class="col-sm-10 card px-2 p-2 rounded">
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#staticBackdrop"><i class="fas fa-edit"></i> {{ __('Nueva Historia') }}</button>
                </div>
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
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medical_history as $m_h)
                    <tr>
                        <td class="text-center">{{ $m_h->name }}</td>
                        <td class="text-center">{{ $m_h->breed }}</td>
                        <td class="text-center">{{ $m_h->gender }}</td>
                        <td class="text-center">{{ $m_h->customer_name }}</td>
                        <td class="text-center">{{ $m_h->document }}</td>
                        <td class="text-center">{{ $m_h->document_name }}</td>
                        <td class="text-center">
                            <a class="btn btn-success btn-sm open-modal" data-toggle="modal" data-target="#staticBackdrop_two_{{$m_h->id_medical_history}}" title="Agregar Mascota"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-info btn-sm" href="{{ route('medical_history.show', $m_h->id_medical_history) }}" title="Ver más"><i class="fas fa-eye"></i></a>
                        </td>
                        <td class="text-center">
                            <?php
                            if ($m_h->medical_history_state_record == 'ACTIVO') {
                            ?>
                                <form class="formulario-disable" action="{{route('medical_history.delete', $m_h->id_medical_history) }}" method="get">
                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true" title="Eliminar"></i></button>
                                </form>
                            <?php
                            }
                            ?>
                            <!-- Modal Old-->
                            <div class="modal fade" id="staticBackdrop_two_{{$m_h->id_medical_history}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="staticBackdropLabel">Nueva Mascota</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form class="formulario-send_request" action="{{ route('medical_history.create_old', $m_h->id_customer) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h5>{{ __('PET_DATA') }}</h5>
                                                </div>
                                                <div class="form-group">
                                                    <label class="d-flex justify-content-start" for="reserva">{{ __('NAME_PET') }}:</label>
                                                    <input class="p-1 mb-2 bg-white text-dark form-control" style="border: none;outline: none;border-bottom: 2px solid #717171;" required maxlength="45" type="text" id="name_pet_old" name="name_pet_old" placeholder="Nombre de la mascota" oninput="this.value = this.value.replace(/[^a-zA-Z- -]/,'')" required>
                                                </div>

                                                <div class="form-group ">
                                                    <label class="d-flex justify-content-start" for="asunto">{{ __('BREED') }}:</label>
                                                    <input class="p-1 mb-2 bg-white text-dark form-control" style="border: none;outline: none;border-bottom: 2px solid #717171;" required maxlength="45" type="text" id="breed_pet_old" name="breed_pet_old" placeholder="Raza de la mascota" oninput="this.value = this.value.replace(/[^a-zA-Z- -]/,'')" required>
                                                </div>
                                                <div class="form-group d-flex justify-content-start">
                                                    <label class="d-flex justify-content-start" for="reserva">{{ __('GENDER') }}:</label>
                                                    <select style="border-radius:10px;margin: 0% 0% 0% 1%;" class="btn btn-light" aria-label="Default select example" id="type_gender_pet_old" name="type_gender_pet_old" required>
                                                        <option value="">--Seleccione el genero--</option>
                                                        <option value="{{ __('FEMALE_PET') }}">{{ __('FEMALE_PET') }}</option>
                                                        <option value="{{ __('MALE_PET') }}">{{ __('MALE_PET') }}</option>
                                                    </select>
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
                        </td>

                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="staticBackdropLabel">Nuevo Historial Medico</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="formulario-send_request" action="{{ route('medical_history.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="text-center">
                        <h5>{{ __('OWNER_DATA') }}</h5>
                    </div>

                    <div class="form-group">
                        <label for="reserva">{{ __('NAME_CUSTOMER') }}:</label>
                        <input class="p-1 mb-2 bg-white text-dark form-control" style="border: none;outline: none;border-bottom: 2px solid #717171;" required maxlength="45" type="text" id="name_customer" name="name_customer" placeholder="Nombre del propietario" oninput="this.value = this.value.replace(/[^a-zA-Z- -]/,'')" required>
                    </div>

                    <div class="form-group">
                        <label for="asunto">{{ __('DOCUMENT') }}:</label>
                        <input class="p-1 mb-2 bg-white text-dark form-control" style="border: none;outline: none;border-bottom: 2px solid #717171;" required maxlength="45" type="text" id="document_customer" name="document_customer" placeholder="Documento del propietario" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z- 0-9]/,'')" required>
                    </div>
                    <div class="form-group">
                        <label for="asunto">{{ __('DOCUMENT_TYPE') }}:</label>
                        <select style="border-radius:10px;margin: 0% 0% 0% 1%;" class="btn btn-light" aria-label="Default select example" name="type_document" required>
                            <option value="">--Seleccione el tipo--</option>
                            <option value="1">{{ __('CITIZENSHIP_CARD') }}</option>
                            <option value="2">{{ __('IDENTITY_CARD') }}</option>
                            <option value="3">{{ __('PASSPORT') }}</option>
                            <option value="4">{{ __('FOREIGNER_ID') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="reserva">{{ __('GENDER') }}:</label>
                        <select style="border-radius:10px;margin: 0% 0% 0% 1%;" class="btn btn-light" aria-label="Default select example" name="type_gender" required>
                            <option value="">--Seleccione el genero--</option>
                            <option value="{{ __('FEMALE') }}">{{ __('FEMALE') }}</option>
                            <option value="{{ __('MALE') }}">{{ __('MALE') }}</option>
                            <option value="{{ __('OTHER') }}">{{ __('OTHER') }}</option>
                        </select>
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
                        <select style="border-radius:10px;margin: 0% 0% 0% 1%;" class="btn btn-light" aria-label="Default select example" name="type_gender_pet" required>
                            <option value="">--Seleccione el genero--</option>
                            <option value="{{ __('FEMALE_PET') }}">{{ __('FEMALE_PET') }}</option>
                            <option value="{{ __('MALE_PET') }}">{{ __('MALE_PET') }}</option>
                        </select>
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


@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">


@stop

@section('js')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('js/datatables.js')}}"></script>

<script>
    $(document).ready(function() {
        $('.open-modal').click(function() {
            var modalId = $(this).data('modal-target');
            $(modalId).modal('show');
        });
    });
</script>

<script>
    window.addEventListener('DOMContentLoaded', function() {
        var form = document.querySelector('.formulario-send_request');
        var formFields = form.querySelectorAll('input, select, textarea');

        if (localStorage.getItem('formCache')) {
            var formCache = JSON.parse(localStorage.getItem('formCache'));

            for (var i = 0; i < formFields.length; i++) {
                var fieldName = formFields[i].name;
                if (formCache[fieldName]) {
                    formFields[i].value = formCache[fieldName];
                }
            }
        }

        form.addEventListener('submit', function() {
            var formCache = {};

            for (var i = 0; i < formFields.length; i++) {
                var fieldName = formFields[i].name;
                var fieldValue = formFields[i].value;
                formCache[fieldName] = fieldValue;
            }

            localStorage.setItem('formCache', JSON.stringify(formCache));
        });
    });

    window.addEventListener('load', function() {
        localStorage.removeItem('formCache');
    });
</script>

@if(session('save')){
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Historia clinica creada!',
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
        text: 'Este cliente ya se encuantra registrado',
        footer: 'Por favor, intente en "Clientes Antiguos"'
    })
</script>
}
@endif

@if(session('yes_exist_pet')) {
<script>
    Swal.fire({
        icon: 'error',
        title: 'Lo siento!',
        text: 'La mascota ya se encuentra registrada a nombre del cliente',
        footer: 'Ya existe'
    })
</script>
}
@endif

<script>
    $('.formulario-disable').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Esta seguro de eliminar el historial médico?',
            text: "Esto eliminara por completo el historial de la mascota!",
            icon: 'warning',
            showDenyButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Eliminar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            } else if (result.isDenied) {
                Swal.fire('No se elimino el historial!!', '', 'info')
            }
        })
    })
</script>

@stop