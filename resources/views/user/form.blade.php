@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1 align="center">FENIX GYM</h1>
            {!! Form::model($customer,['method' => 'POST', 'url' => 'customer/profile/save', 'class' => 'form-horizontal']) !!}
              <input type="hidden" name="id" value="{{ $customer['id'] }}">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Agrega Cliente</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                            {!! Form::label('first_name', 'Nombres') !!}
                                            {!! Form::text('first_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                            <small class="text-danger">{{ $errors->first('first_name') }}</small>
                                        </div>

                                        <div class="form-group{{ $errors->has('last name') ? ' has-error' : '' }}">
                                            {!! Form::label('last_name', 'Apellidos') !!}
                                            {!! Form::text('last_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                            <small class="text-danger">{{ $errors->first('  last_name') }}</small>
                                        </div>

                                        <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                                            {!! Form::label('date_of_birth', 'Fecha de Nacimiento') !!}
                                            {!! Form::date('date_of_birth', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                            <small class="text-danger">{{ $errors->first('date_of_birth') }}</small>
                                        </div>

                                       <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
                                           {!! Form::label('sex', 'Sexo') !!}
                                           {!! Form::select('sex',$genes, null, ['id' => 'sex', 'class' => 'form-control', 'required' => 'required','@click'=>'toggleIsWeb($event)']) !!}
                                           <small class="text-danger">{{ $errors->first('sex') }}</small>
                                       </div>


                                        <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                                            {!! Form::label('telephone', 'Telefono') !!}
                                            {!! Form::text('telephone', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                            <small class="text-danger">{{ $errors->first('telephone') }}</small>
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
                                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                            {!! Form::label('address', 'Direccion') !!}
                                            {!! Form::textarea('address', null, ['class' => 'form-control', 'required' => 'required','rows'=>3]) !!}
                                            <small class="text-danger">{{ $errors->first('address') }}</small>
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
                                       <div class="form-group{{ $errors->has('address_envoice') ? ' has-error' : '' }}">
                                           {!! Form::label('address_envoice', 'Direccion de Factura') !!}
                                           {!! Form::textarea('address_envoice',null, ['class' => 'form-control', 'required' => 'required','rows'=>3]) !!}
                                           <small class="text-danger">{{ $errors->first('address_envoice') }}</small>
                                       </div>

                                       <div class="form-group{{ $errors->has('wheigth') ? ' has-error' : '' }}">
                                           {!! Form::label('wheigth', 'Peso') !!}
                                           {!! Form::text('wheigth', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                           <small class="text-danger">{{ $errors->first('wheigth') }}</small>
                                       </div>

                                       <div class="form-group{{ $errors->has('height') ? ' has-error' : '' }}">
                                           {!! Form::label('height', 'Estatura') !!}
                                           {!! Form::text('height', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                           <small class="text-danger">{{ $errors->first('height') }}</small>
                                       </div>

                                       <div class="form-group{{ $errors->has('diseases') ? ' has-error' : '' }}">
                                           {!! Form::label('diseases', 'Enfermedades') !!}
                                           {!! Form::text('diseases', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                           <small class="text-danger">{{ $errors->first('diseases') }}</small>
                                       </div>

                                       <div class="form-group{{ $errors->has('observations') ? ' has-error' : '' }}">
                                           {!! Form::label('observations', 'Observaciones') !!}
                                           {!! Form::textarea('observations', null, ['class' => 'form-control', 'required' => 'required','rows'=>3]) !!}
                                           <small class="text-danger">{{ $errors->first('observations') }}</small>
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
