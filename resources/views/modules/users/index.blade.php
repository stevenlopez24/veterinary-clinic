@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<h1>{{ __('Users management') }}</h1>
@stop

@section('content')

<div class="content container ">
    <div class="col-sm-12">
        <div class="card px-3 p-3 rounded">

            <br>
            <div class="dataTables_length">

                <table id="tabla" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">{{ __('NAME') }}</th>
                            <th class="text-center">{{ __('EMAIL') }}</th>
                            <th class="text-center">{{ __('ROLE') }}</th>
                            <th class="text-center">{{ __('CREATION TIME') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="text-center">{{ $user->name }}</td>
                            <td class="text-center">{{ $user->email }}</td>
                            <td class="text-center">{{ $user->role_name }}</td>
                            <td class="text-center">{{ date('d/m/Y', strtotime($user->create_time)) }}</td>                            
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
    <script src="{{asset('js/datatables.js')}}"></script>

    @stop
