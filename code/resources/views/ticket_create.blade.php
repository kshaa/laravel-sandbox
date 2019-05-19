@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add a new ticket</div>
                <div class="card-body">
                    {!! Form::open(['action' => 'TicketsController@store', 'class' => 'form-horizontal']) !!}

                    <div class="form-group row">
                    {!! Form::label('event', 'Event', ['class' => 'col-md-4 control-label text-md-right']) !!}
                    <div class="col-md-6">
                    {!! Form::select('event', $events, '', ['class' => 'form-control '.($errors->has('event') ? ' is-invalid' : '' )]) !!}
                    @if ($errors->has('event'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('event') }}</strong>
                        </span>
                    @endif
                    </div>
                    </div>                    
                    <div class="form-group row">
                    {!! Form::label('row', 'Row',['class' => 'col-md-4 control-label text-md-right']) !!}
                    <div class="col-md-6">
                    {!! Form::number('row', '', ['class' => 'form-control '.($errors->has('row') ? ' is-invalid' : '' )]) !!}
                    @if ($errors->has('row'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('row') }}</strong>
                        </span>
                    @endif
                    </div>
                    </div>
                    <div class="form-group row">
                    {!! Form::label('seat', 'Seat',['class' => 'col-md-4 control-label text-md-right']) !!}
                    <div class="col-md-6">
                    {!! Form::number('seat', '', ['class' => 'form-control '.($errors->has('seat') ? ' is-invalid' : '' )]) !!}
                    @if ($errors->has('seat'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('seat') }}</strong>
                        </span>
                    @endif
                    </div>
                    </div>
                    
                    <div class="form-group row">
                    {!! Form::label('price', 'Price',['class' => 'col-md-4 control-label text-md-right']) !!}
                    <div class="col-md-6">
                    {!! Form::number('price', '', ['class' => 'form-control '.($errors->has('price') ? ' is-invalid' : '' ), 'step' => '0.01', 'min' => 0]) !!}
                    @if ($errors->has('price'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                    </div>
                    </div>

                    <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                    {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                    </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 