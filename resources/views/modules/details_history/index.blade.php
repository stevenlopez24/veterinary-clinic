@extends('adminlte::page')

@section('title', 'Mascotas')

@section('content_header')
<h1>{{ __('Pets management') }}</h1>
@stop

@section('content')
<div class="content container ">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6 card px-2 p-2 rounded d-flex align-items-center">
                <div class="col-sm-10 card px-2 p-2 rounded">
                    <a class="btn btn-primary btn-lg " href="">
                        <i class="fas fa-edit"></i> {{ __('Cliente Nuevo') }}
                    </a>
                </div>
            </div>
            <div class="col-sm-6 card px-2 p-2 rounded d-flex align-items-center">
                <div class="col-sm-10 card px-2 p-2 rounded">
                    <a class="btn btn-secondary btn-lg " href="">
                        <i class="fas fa-edit"></i> {{ __('Cliente Antiguo') }}
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
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detail as $deta)
                        <tr>
                            <td class="text-center">{{ $deta->name }}</td>
                            <td class="text-center">{{ $deta->breed }}</td>
                            <td class="text-center">{{ $deta->gender }}</td>
                            <td class="text-center">{{ $deta->name_customer }}</td>
                            <td class="text-center">{{ $deta->document }}</td>

                            <td class="text-center">

                                <a class="btn btn-info btn-sm rounded-pill" href="">
                                    <i class="fas fa-eye"></i> {{ __('See More') }}
                                </a>

                            </td>
                            <td class="text-center">

                                <a class="btn btn-success btn-sm rounded-pill" href="">
                                    <i class="fas fa-edit"></i> {{ __('Edit') }}
                                </a>

                            </td>
                            <td class="text-center">
                                <?php
                                if ($pet->state_record == 'ACTIVO') {
                                ?>
                                    <form action="{{route('pet.delete', $pet->id_pet) }}" class="desactivar" method="get">
                                        <button class="btn btn-danger btn-sm rounded-pill"><i class="fas fa-lock"></i> {{ __('Disable') }}</button>
                                    </form>
                                <?php
                                }
                                ?>

                                <?php
                                if ($pet->state_record == 'DESACTIVAR') {
                                ?>
                                    <form action="{{route('user.delete', $user->id) }}" class="activar" method="get">
                                        <button class="btn btn-warning btn-sm text-white rounded-pill"><i class="fas fa-lock-open"></i> {{ __('Activate') }} </button>
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

    @stop