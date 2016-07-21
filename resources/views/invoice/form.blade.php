@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1 align="center">FENIX GYM</h1>
            {!! Form::open(['method' => 'POST', 'url' => 'customer/profile/save', 'class' => 'form-horizontal']) !!}
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Factura Cliente:</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group{{ $errors->has('nombres') ? ' has-error' : '' }}">
                                            {!! Form::label('customer_id', 'Cedula') !!}
                                            {!! Form::text('customer_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                            <small class="text-danger">{{ $errors->first('customer_id') }}</small>
                                        </div>

                                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                            {!! Form::label('status', 'Estatus') !!}
                                            {!! Form::text('status', null, ['class' => 'form-control',''=> 'required']) !!}
                                            <small class="text-danger">{{ $errors->first('status') }}</small>
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
