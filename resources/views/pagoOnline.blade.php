@extends('layouts.app')

@section('content')
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
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

                                                <form action="">
                                                    <a name="realizarPago" id="paypal-button-container-{{$pagos->id}}" class="btn-paypal" href="{{ url('pagoConfirmado') }}"></a>
                                                    <script>

                                                        paypal.Button.render({

                                                            env: 'sandbox', // sandbox | production

                                                            locale: 'es_PE',
                                                            style: {
                                                                label: 'checkout',
                                                                size:  'small',
                                                                shape: 'pill',
                                                                color: 'blue'
                                                            },


                                                            client: {
                                                                sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
                                                                production: '<insert production client id>'
                                                            },

                                                            payment: function(data, actions) {
                                                                return actions.payment.create({
                                                                    payment: {
                                                                        transactions: [
                                                                            {
                                                                                amount: { total: {{ $pagos->monto }}, currency: 'USD' },
                                                                                description: "Esta pagando $ <?php echo $pagos->monto; ?> de la <?php echo $pagos->detalle; ?>"
                                                                            }
                                                                        ]
                                                                    }
                                                                });
                                                            },

                                                            onAuthorize: function(data, actions) {
                                                                return actions.payment.execute().then(
                                                                    function() {
                                                                        document.querySelector('#paypal-button-container-{{$pagos->id}}')
                                                                            .innerText = 'Pago Realizado!';

                                                                            saveData({{$pagos->id}});

                                                                    }
                                                                );
                                                            }

                                                        }, '#paypal-button-container-{{$pagos->id}}');

                                                    </script>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            @if($pagos == null)
                                @foreach ($pagos as $pagos)
                                    <h4 class= "text-center">No hay pagos por mostrar</h4>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script rel="javascript" type="text/javascript" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/core.js"></script>
    
    <script>
        function saveData(idPago){
 $.get('/pagoOnlines',
    {
        id: idPago,
        status: "PAGADO"
    },
    function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
    });
  }
    </script>
@endsection