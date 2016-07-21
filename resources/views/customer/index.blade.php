@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h1 class="text-center">Listas de Clientes</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>cedula</th>
                    <th>Nombre Completo</th>
                    <th>Sexo</th>
                    <th>Telefono</th>
                    <th>Correo Electronico</th>
                    <th>Estatus</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
            {{-- {{ dd($customers) }} --}}
                @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td class="text-capitalize">{{ $customer->user->full_name }}</td>
                    <td>{{ $customer->user->sex }}</td>
                    <td>{{ $customer->user->telephone }}</td>
                    <td>{{ $customer->user->email }}</td>
                    <td>{{ $customer->status }}</td>
                    <td>
                    {{-- boton para editar al cliente --}}
                        <a href="/customer/profile/{{ $customer->id }}" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- boton para devolverse al formulario agregar cliente --}}
        <a href="/customer/profile/" class="btn btn-info pull-right">Registrar Clientes</a>
    </div>
</div>
@endsection