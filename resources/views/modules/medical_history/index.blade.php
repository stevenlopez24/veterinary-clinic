@extends('adminlte::page')

@section('title', 'Mascotas')

@section('content_header')
<h1>{{ __('MEDICAL_RECORD_MANAGEMENT') }}</h1>
@stop

@section('content')
<div class="content container ">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6 card px-2 p-2 rounded d-flex align-items-center">
                <div class="col-sm-10 card px-2 p-2 rounded">
                    <a class="btn btn-secondary btn-lg " href="">
                        <i class="fas fa-edit"></i> {{ __('Cliente Antiguo') }}
                    </a>
                </div>
            </div>
            <div class="col-sm-6 card px-2 p-2 rounded d-flex align-items-center">
                <div class="col-sm-10 card px-2 p-2 rounded">
                    <a class="btn btn-success btn-lg " href="">
                        <i class="fas fa-edit"></i> {{ __('Cliente Nuevo') }}
                    </a>
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
                                <a class="btn btn-info btn-sm" href="{{ route('medical_history.show', $m_h->id_medical_history) }}"><i class="fas fa-eye"></i> {{ __('See More') }}</a>
                            </td>
                            <td class="text-center">
                                <?php
                                if ($m_h->medical_history_state_record == 'ACTIVO') {
                                ?>
                                    <form class="formulario-disable" action="{{route('medical_history.delete', $m_h->id_medical_history) }}" method="get">
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-lock"></i> {{ __('Disable') }}</button>
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


    @if(session('update')) {
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: 'PQRS actualizada'
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

        // $('.formulario-activate').submit(function(e) {
        //     e.preventDefault();

        //     Swal.fire({
        //         title: '¿Esta seguro de eliminar el historial clinico??',
        //         showDenyButton: true,
        //         confirmButtonText: 'Activar',
        //         denyButtonText: `Cancelar`,
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             this.submit();
        //         } else if (result.isDenied) {
        //             Swal.fire('No se activo la reserva!!', '', 'info')
        //         }
        //     })
        // })

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