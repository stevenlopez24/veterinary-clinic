@extends('adminlte::page')

@section('title', 'Informacion de cliente')

@section('content_header')
<h1 style="font-weight: bold;text-align: center;">{{ __('MEDICAL_HISTORY_INFORMATION') }}</h1>
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
                    <div class="form-group">
                        <label>{{ __('CREATE_TIME') }}:</label>
                        <span>{{ $detail->create_time }}</span><br>

                        <label>{{ __('UPDATE_TIME') }}:</label>
                        <span>{{ $detail->update_time }}</span><br>

                        <label>{{ __('STATE_RECORD') }}:</label>
                        <span>{{ $detail->medical_history_state_record }}</span><br>
                    </div>
                    <hr>
                    <div class="row mb-12 justify-content-end">
                        <div class="row-mb-10">
                            <?php
                            if ($detail->medical_history_state_record == 'ACTIVO') {
                            ?>
                                <form class="formulario-disable" action="{{ route('medical_history.delete', $detail->id_medical_history) }}" method="GET">
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
                <a href="{{ route('medical_history.index') }}" class="btn btn-primary"><i class="fas fa-undo-alt"></i> {{ __('Return') }}</a>
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
                <h3 class="modal-title" id="staticBackdropLabel">Edición De Historial Medico</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="formulario-send_request" action="{{ route('medical_history.update', ['medical_history' => $detail->id_medical_history, 'pet' => $detail->id_pet, 'customer' => $detail->id_customer]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="text-center">
                        <h5>{{ __('OWNER_DATA') }}</h5>
                    </div>

                    <div class="form-group">
                        <label for="reserva">{{ __('NAME_CUSTOMER') }}:</label>
                        <input class="p-1 mb-2 bg-white text-dark form-control" value="{{ $detail->customer_name }}" style="border: none;outline: none;border-bottom: 2px solid #717171;" required maxlength="45" type="text" id="name_customer" name="name_customer" placeholder="Nombre del propietario" oninput="this.value = this.value.replace(/[^a-zA-Z- -]/,'')" required>
                    </div>

                    <div class="form-group">
                        <label for="asunto">{{ __('DOCUMENT') }}:</label>
                        <input class="p-1 mb-2 bg-white text-dark form-control" value="{{ $detail->document }}" readonly="readonly" style="border: none;outline: none;border-bottom: 2px solid #717171;" required maxlength="45" type="text" id="document_customer" name="document_customer" placeholder="Documento del propietario" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z- 0-9]/,'')" required>
                    </div>
                    <div class="form-group">
                        <label for="asunto">{{ __('DOCUMENT_TYPE') }}:</label>
                        <select style="border-radius:10px;margin: 0% 0% 0% 1%;" class="btn btn-light" aria-label="Default select example" id="type_document" name="type_document" required>
                            <option value="">--Seleccione el tipo--</option>
                            <option value="1" {{$detail->document_name == 'Cédula de ciudadanía' ? 'selected' : '1' }}>{{ __('CITIZENSHIP_CARD') }}</option>
                            <option value="2" {{$detail->document_name == 'Tarjeta de identidad' ? 'selected' : '2' }}>{{ __('IDENTITY_CARD') }}</option>
                            <option value="3" {{$detail->document_name == 'Pasaporte' ? 'selected' : '3' }}>{{ __('PASSPORT') }}</option>
                            <option value="4" {{$detail->document_name == 'Cédula de Extranjería' ? 'selected' : '4' }}>{{ __('FOREIGNER_ID') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="reserva">{{ __('GENDER') }}:</label>
                        <select style="border-radius:10px;margin: 0% 0% 0% 1%;" class="btn btn-light" aria-label="Default select example" id="type_gender" name="type_gender" required>
                            <option value="">--Seleccione el genero--</option>
                            <option value="{{ __('FEMALE') }}" {{$detail->customer_gender == 'Femenino' ? 'selected' : '' }}>{{ __('FEMALE') }}</option>
                            <option value="{{ __('MALE') }}" {{$detail->customer_gender == 'Masculino' ? 'selected' : '' }}>{{ __('MALE') }}</option>
                            <option value="{{ __('OTHER') }}" {{$detail->customer_gender == 'Otro' ? 'selected' : '' }}>{{ __('OTHER') }}</option>
                        </select>
                    </div>
                    <hr>
                    <div class="text-center">
                        <h5>{{ __('PET_DATA') }}</h5>
                    </div>
                    <div class="form-group">
                        <label for="reserva">{{ __('NAME_PET') }}:</label>
                        <input class="p-1 mb-2 bg-white text-dark form-control" value="{{ $detail->pet_name }}" style="border: none;outline: none;border-bottom: 2px solid #717171;" required maxlength="45" type="text" id="name_pet" name="name_pet" placeholder="Nombre de la mascota" oninput="this.value = this.value.replace(/[^a-zA-Z- -]/,'')" required>
                    </div>

                    <div class="form-group">
                        <label for="asunto">{{ __('BREED') }}:</label>
                        <input class="p-1 mb-2 bg-white text-dark form-control" value="{{ $detail->breed }}" style="border: none;outline: none;border-bottom: 2px solid #717171;" required maxlength="45" type="text" id="breed_pet" name="breed_pet" placeholder="Raza de la mascota" oninput="this.value = this.value.replace(/[^a-zA-Z- -]/,'')" required>
                    </div>
                    <div class="form-group">
                        <label for="reserva">{{ __('GENDER') }}:</label>
                        <select style="border-radius:10px;margin: 0% 0% 0% 1%;" class="btn btn-light" aria-label="Default select example" name="type_gender_pet" required>
                            <option value="">--Seleccione el genero--</option>
                            <option value="{{ __('FEMALE_PET') }}" {{$detail->pet_gender == 'Hembra' ? 'selected' : '' }}>{{ __('FEMALE_PET') }}</option>
                            <option value="{{ __('MALE_PET') }}" {{$detail->pet_gender == 'Macho' ? 'selected' : '' }}>{{ __('MALE_PET') }}</option>
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

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('update')){
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Historia clinica modificada!',
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