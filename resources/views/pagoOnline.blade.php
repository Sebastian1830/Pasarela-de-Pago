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
                                                    <a name="realizarPago" id="paypal-button-container" href="{{ url('pagoConfirmado') }}"></a>
                                                    <script>

                                                        // Render the PayPal button

                                                        paypal.Button.render({

                                                            // Set your environment

                                                            env: 'sandbox', // sandbox | production

                                                            // Specify the style of the button
                                                            locale: 'es_PE',
                                                            style: {
                                                                label: 'checkout',
                                                                size:  'small',    // small | medium | large | responsive
                                                                shape: 'pill',     // pill | rect
                                                                color: 'blue'      // gold | blue | silver | black
                                                            },

                                                            // PayPal Client IDs - replace with your own
                                                            // Create a PayPal app: https://developer.paypal.com/developer/applications/create

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
                                                                                description: "Esta pagando $ <?php echo $pagos->monto ?> de la <?php echo $pagos->detalle ?>"
                                                                            }
                                                                        ]
                                                                    }
                                                                });
                                                            },

                                                            onAuthorize: function(data, actions) {
                                                                return actions.payment.execute().then(
                                                                    function() {
                                                                        document.querySelector('#paypal-button-container')
                                                                            .innerText = 'Payment Complete!';
                                                                    }
                                                                );
                                                            }

                                                        }, '#paypal-button-container');

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
@endsection