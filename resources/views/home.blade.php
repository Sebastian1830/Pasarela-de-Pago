@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bienvenido(a) &nbsp{{ auth()->user()->nickname }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- ***** Product Area Start ***** -->
                    <section class="about_area app_landing_version section_padding_100_70" id="feature">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <!-- Section Heading Start -->
                                    <div class="section_heading wow fadeInUp">
                                        <h2>Que deseas<span> hacer hoy?</span></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="about_product_discription">
                                        <div class="row">
                                            <!-- Single About Part Area Start-->
                                            <div class="col-12 col-sm-6 col-lg-4" >
                                                <a href="{{ url('pagoOnline') }}">
                                                    <div class="single_about_part wow fadeInUp">
                                                        <div class="feature_icon">
                                                            <i class="fa fa-pagelines" aria-hidden="true"></i>
                                                        </div>
                                                        <h5>Pagar Online</h5>
                                                        <p style="text-align: center">Ahorra tu tiempo y da click aqui para pagar la pension de tu hijo(a).</p>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-12 col-sm-6 col-lg-4">
                                                <div class="single_about_part wow fadeInUp">
                                                    <div class="feature_icon">
                                                        <i class="fa fa-gamepad" aria-hidden="true"></i>
                                                    </div>
                                                    <h5>Reporte de Notas</h5>
                                                    <p>Da un seguimiento continuo del desarrollo intelectual de tu hijo.</p>
                                                </div>
                                            </div>
                                            <!-- Single About Part Area Start-->
                                            <div class="col-12 col-sm-6 col-lg-4">
                                                <div class="single_about_part wow fadeInUp">
                                                    <div class="feature_icon">
                                                        <i class="fa fa-fighter-jet" aria-hidden="true"></i>
                                                    </div>
                                                    <h5>Observaciones de Docentes</h5>
                                                    <p>Recive comentarios de como mejorar el desarrollo intelectual de tu hijo desde la comodidad de tu hogar.</p>
                                                </div>
                                            </div>
                                            <!-- Single About Part Area Start-->
                                            <div class="col-12 col-sm-6 col-lg-4">
                                                <div class="single_about_part wow fadeInUp">
                                                    <div class="feature_icon">
                                                        <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
                                                    </div>
                                                    <h5>Notificaciones</h5>
                                                    <p>Recive los ultimos avisos del colegio desde la web.</p>
                                                </div>
                                            </div>
                                            <!-- Single About Part Area Start-->
                                            <div class="col-12 col-sm-6 col-lg-4">
                                                <div class="single_about_part wow fadeInUp">
                                                    <div class="feature_icon">
                                                        <i class="fa fa-laptop" aria-hidden="true"></i>
                                                    </div>
                                                    <h5>Chat Docente</h5>
                                                    <p>Comunicate con el docente de tu hijo mediante nuestra plataforma de chat gratuita.</p>
                                                </div>
                                            </div>
                                            <!-- Single About Part Area Start-->
                                            <div class="col-12 col-sm-6 col-lg-4">
                                                <div class="single_about_part wow fadeInUp">
                                                    <div class="feature_icon">
                                                        <i class="fa fa-mobile" aria-hidden="true"></i>
                                                    </div>
                                                    <h5>Proximamente en Android</h5>
                                                    <p>Estamos trabajando para que tengas mayor accesibilidad a nuestro servicio.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- ***** Product Area End ***** -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
