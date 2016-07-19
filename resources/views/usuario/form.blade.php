@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1 align="center">FENIX GYM</h1>
            {!! Form::open(['method' => 'POST', 'url' => 'customer/profile/save', 'class' => 'form-horizontal']) !!}
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Agrega Cliente</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group{{ $errors->has('nombres') ? ' has-error' : '' }}">
                                            {!! Form::label('nombres', 'Nombres') !!}
                                            {!! Form::text('nombres', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                            <small class="text-danger">{{ $errors->first('nombres') }}</small>
                                        </div>

                                        <div class="form-group{{ $errors->has('apellidos') ? ' has-error' : '' }}">
                                            {!! Form::label('apellidos', 'Apellidos') !!}
                                            {!! Form::text('apellidos', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                            <small class="text-danger">{{ $errors->first('apellidos') }}</small>
                                        </div>

                                        <div class="form-group{{ $errors->has('fecha_nac') ? ' has-error' : '' }}">
                                            {!! Form::label('fecha_nac', 'Fecha de Nacimiento') !!}
                                            {!! Form::date('fecha_nac', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                            <small class="text-danger">{{ $errors->first('fecha_nac') }}</small>
                                        </div>

                                       <div class="form-group{{ $errors->has('sexo') ? ' has-error' : '' }}">
                                           {!! Form::label('sexo', 'Sexo') !!}
                                           {!! Form::select('sexo',['','F','M'], null, ['id' => 'sexo', 'class' => 'form-control', 'required' => 'required','@click'=>'toggleIsWeb($event)']) !!}
                                           <small class="text-danger">{{ $errors->first('sexo') }}</small>
                                       </div>


                                        <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                            {!! Form::label('telefono', 'Telefono') !!}
                                            {!! Form::text('telefono', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                            <small class="text-danger">{{ $errors->first('telefono') }}</small>
                                        </div>

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            {!! Form::label('email', 'Correo Electronico') !!}
                                            {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                            <small class="text-danger">{{ $errors->first('email') }}</small>
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            {!! Form::label('password', 'Contraseña') !!}
                                            {!! Form::password('password', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                            <small class="text-danger">{{ $errors->first('password') }}</small>
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            {!! Form::label('password', 'Confirmar Contraseña') !!}
                                            {!! Form::password('password', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                            <small class="text-danger">{{ $errors->first('password') }}</small>
                                        </div>
                                        <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                                            {!! Form::label('direccion', 'Direccion') !!}
                                            {!! Form::textarea('direccion', null, ['class' => 'form-control', 'required' => 'required','rows'=>3]) !!}
                                            <small class="text-danger">{{ $errors->first('direccion') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Datos del Cliente</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                       <div class="form-group{{ $errors->has('direc_factura') ? ' has-error' : '' }}">
                                           {!! Form::label('direc_factura', 'Direccion de Factura') !!}
                                           {!! Form::textarea('direc_factura',null, ['class' => 'form-control', 'required' => 'required','rows'=>3]) !!}
                                           <small class="text-danger">{{ $errors->first('direc_factura') }}</small>
                                       </div>

                                       <div class="form-group{{ $errors->has('peso') ? ' has-error' : '' }}">
                                           {!! Form::label('peso', 'Peso') !!}
                                           {!! Form::text('peso', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                           <small class="text-danger">{{ $errors->first('peso') }}</small>
                                       </div>

                                       <div class="form-group{{ $errors->has('estatura') ? ' has-error' : '' }}">
                                           {!! Form::label('estatura', 'Estatura') !!}
                                           {!! Form::text('estatura', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                           <small class="text-danger">{{ $errors->first('estatura') }}</small>
                                       </div>

                                       <div class="form-group{{ $errors->has('enfermedades') ? ' has-error' : '' }}">
                                           {!! Form::label('enfermedades', 'Enfermedades') !!}
                                           {!! Form::text('enfermedades', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                           <small class="text-danger">{{ $errors->first('enfermedades') }}</small>
                                       </div>

                                       <div class="form-group{{ $errors->has('observaciones') ? ' has-error' : '' }}">
                                           {!! Form::label('observaciones', 'Observaciones') !!}
                                           {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'required' => 'required','rows'=>3]) !!}
                                           <small class="text-danger">{{ $errors->first('observaciones') }}</small>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-group pull-right">
                    {!! Form::reset("Limpiar", ['class' => 'btn btn-warning']) !!}
                    {!! Form::submit("Agregar", ['class' => 'btn btn-success']) !!}
                </div>


            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
