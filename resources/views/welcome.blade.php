@extends('layouts.dashboard')

@section('content')

<!-- Mashead header-->
        <header class="masthead">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <!-- Mashead text and app badges-->
                        <div class="mb-5 mb-lg-0 text-center text-lg-start">
                            <h1 class="display-3 mb-3" style="font-family: Arial;">CourierTool</h1>
                            <p class="lead fw-normal text-muted mb-5">
                                Gestión y Manejo de múltiples agencias, Casilleros Internacionales y Carga Aérea. Acceso desde cualquier parte del mundo, también cuenta con nuestro soporte técnico el cual puede generar cambios adicionales en caso de que su compañía lo requiera.
                            </p>
                            <div class="d-flex flex-column flex-lg-row align-items-center">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Masthead device mockup feature-->
                        <div class="masthead-device-mockup">
                            <svg class="circle" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <linearGradient id="circleGradient" gradientTransform="rotate(45)">
                                        <stop class="gradient-start-color" offset="0%"></stop>
                                        <stop class="gradient-end-color" offset="100%"></stop>
                                    </linearGradient>
                                </defs>
                                <circle cx="50" cy="50" r="50"></circle></svg><svg class="shape-1 d-none d-sm-block" viewBox="0 0 240.83 240.83" xmlns="http://www.w3.org/2000/svg">
                                <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03" transform="translate(120.42 -49.88) rotate(45)"></rect>
                                <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03" transform="translate(-49.88 120.42) rotate(-45)"></rect></svg><svg class="shape-2 d-none d-sm-block" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="50"></circle></svg>
                            <div class="device-wrapper">
                                <div class="device" data-device="iPhoneX" data-orientation="portrait" data-color="black">
                                    <div class="screen bg-black">
                                        <!-- PUT CONTENTS HERE:-->
                                        <!-- * * This can be a video, image, or just about anything else.-->
                                        <!-- * * Set the max width of your media to 100% and the height to-->
                                        <!-- * * 100% like the demo example below.-->
                                        <img src="{{asset('images/inicioCourierTool.png')}}" alt="..." width="100%" height="100%" alt=""/>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Quote/testimonial aside-->
        <aside class="text-center bg-gradient-primary-to-secondary">
            <div class="container px-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-xl-8">
                        <div class="h4 text-white mb-4 text-justify">
                            Cuando sus clientes pongan una orden en línea su compañía recibe el producto para mandarlo a la residencia del cliente en otro país o destino. Nuestro sistema proveerá soluciones para el rastreo del paquete.
                        </div>
                      
                    </div>
                </div>
            </div>
        </aside>
        <!-- App features section-->
        <section id="features">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-12 order-lg-1 mb-5 mb-lg-0">
                        <div class="container-fluid px-5">
                            <div class="row gx-5">
                                <div class="col-md-4 mb-5">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-box-seam icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Creación de Casilleros</h3>
                                        <p class="text-muted mb-0">Para sus clientes con numeración personalizada.</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-5">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-currency-dollar icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Plataforma de Pago</h3>
                                        <p class="text-muted mb-0">Escogencia de forma de cobro Anticipada o Post-Pago</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-person-check-fill icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Usuarios y Agencias</h3>
                                        <p class="text-muted mb-0">Utilización de múltiples usuarios y agencias con niveles de información limitados.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-5 mb-md-0">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-calculator icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Ingreso de precio, Cargos y Conceptos Aduanales</h3>
                                        <p class="text-muted mb-0"> Adaptados a la necesidad del país para el cálculo automático del cobro.</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-5">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-laptop icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Escogencia de base cálculo</h3>
                                        <p class="text-muted mb-0">Para el cobro por Peso o Volumen.
                                        </p>
                                    </div>
                                </div>
                             
                                <div class="col-md-4 mb-5">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-credit-card icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Realizar Pagos</h3>
                                        <p class="text-muted mb-0">Integración simple para el uso de tarjeta de créditos.</p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- Basic features section-->
        <section class="bg-light">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">
                    <div class="col-12 col-lg-5">
                        <h2 class="display-4 lh-1 mb-4">Enfoque del Sistema</h2>
                        <p class="lead fw-normal text-muted mb-5 mb-lg-0">
                            El sistema se enfoca en el manejo de múltiples agencias, Casilleros Internacionales y carga Aérea y marítima. Puede ser accesado desde cualquier parte del mundo sin ninguna instalación, nuestro soporte técnico puede desarrollar cambios adicionales solo para su compañía.
                        </p>
                    </div>
                    <div class="col-sm-8 col-md-6">
                        <div class="px-5 px-sm-0"><img class="img-fluid rounded-circle" src="{{asset('images/inicio7.jfif')}}" width="400" height="650" alt="..." /></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Call to action section-->
        <section class="cta">
            <div class="cta-content">
                <div class="container px-5">
                    <h2 class="text-white display-1 lh-1 mb-4">
                        Stop waiting.
                        <br />
                        Start building.
                    </h2>
                    <a class="btn btn-outline-light py-3 px-4 rounded-pill" href="https://startbootstrap.com/theme/new-age" target="_blank">Download for free</a>
                </div>
            </div>
        </section>
        <!-- App badge section-->
        <section class="bg-gradient-primary-to-secondary" id="download">
            <div class="container px-5">
                <h2 class="text-center text-white font-alt mb-4">Get the app now!</h2>
                <div class="d-flex flex-column flex-lg-row align-items-center justify-content-center">
                    <a class="me-lg-3 mb-4 mb-lg-0" href="#!"><img class="app-badge" src="{{asset('theme-home/assets/img/google-play-badge.svg')}}" alt="..." /></a>
                    <a href="#!"><img class="app-badge" src="{{asset('theme-home/assets/img/app-store-badge.svg')}}" alt="..." /></a>
                </div>
            </div>
        </section>
        
@endsection