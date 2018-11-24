@extends('layouts.app')

@section('content') 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lista de pagos pendientes</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="">
                    <select name="alumno_id" id="alumno_id" class="form-control" autofocus @if($exist && $pagos == null) onfocus="this.form.submit()" @endif>
                        @foreach ($alumnos as $alumno)
                            <option onclick="this.form.submit()" value="{{ $alumno->id }}">{{ $alumno->nombres }}</option>
                        @endforeach
                    </select>
                    </form>
                    
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Fecha Inicio</th>
                                <th scope="col">Fecha Fin</th>
                                <th scope="col">Detalle</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($pagos != null)

                                @foreach ($pagos as $pagos)
                                    <tr>
                                    <th scope="row">{{ $pagos->id }}</th>
                                    <td>{{ $pagos->fechaIni }}</td>
                                    <td>{{ $pagos->fechaFin }}</td>
                                    <td>{{ $pagos->detalle }}</td>
                                    <td>{{ $pagos->monto }}</td>
                                    <td>
                                        <a class="btn default-button-green">pagar</a>
                                    </td>
                                    </tr>
                                @endforeach
                                @endif                                
                            </tbody>
                        </table>
                        @if($pagos != null)
                        @foreach ($pagos as $pagos)
                            <label >{{ $pagos }}</label>
                        @endforeach
                        @else
                        <h4 class= "text-center">No hay pagos por mostrar</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>                
@endsection