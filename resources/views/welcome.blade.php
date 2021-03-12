@extends('layouts.app')

@section('content')
    <!-- Masthead-->
    <header class="masthead" id="title">
        <div class="container">
            <div class="masthead-heading text-uppercase">Venta de frutas, verduras y carnes</div>
            <div class="masthead-subheading">Calidad garantizada<br> Área Metropolitana de Bucaramanga 2020</div>
            <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">WhatsApp</a>
        </div>
    </header>
   
    <!-- Services-->
    <section class="page-section" id="store">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">BIENVENIDO A FRUVER AMB EXPRESS</h2>
                <h3 class="section-subheading text-muted"><p class="text-muted">Venta de frutas, verduras y carnes al mejor precio y de la mejor calidad garantizando inocuidad y las medidas de bioseguridad.
                    <br>Nos consideramos expertos en el tema; estamos siempre acompañados por el personal más eficiente, profesional y oportuno para brindarte la satisfacción que mereces.
                </p>
                <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="/tienda">¡Realiza tu pedido aqui!</a>
            </h3>
                
            </div>
            <div class="row text-center">
                <div class="col-md-5">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-virus-slash fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Yo te cuido, tu me cuidas</h4>
                    <p class="text-muted">Porque nos preocupa tu salud y bienestar hemos implementado todos los protocolos de bioseguridad.
                    </p>  
                    <a class="btn btn-primary text-uppercase js-scroll-trigger" href="/tienda">¡Compra ahora!</a>
                </div>
                <div class="col-md-7">
                    <img src="assets\fruver-img\PROTOCOLO - FRUVER AMB.jpg" alt="" width="600" height="600"/>
                </div>
            </div>
        </div>
    </section>
    <!-- About-->
    <section class="page-section bg-light" id="services">
        <div class="container">
            <div class="text-center">
            <h2 class="section-heading text-uppercase tex-center">Nosotros</h2><br>
            <div class="row">
                <div class="col-md-6">
                    <h3>Comunicate con con nosotros</h3>
                    <p><span class="fa-stack fa-2x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fab fa-whatsapp fa-stack-1x fa-inverse" ></i>
                        </span><br>
                        +57 (318) 377-8217<br>
                        +57 (7) 6348-665<br>
                        
                        <a href="https://www.facebook.com/100801784979909">
                        <span class="fa-stack fa-2x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fab fa-facebook-f fa-stack-1x fa-inverse" ></i>
                        </span></a>
                        <a href="https://www.instagram.com/fruveramb">
                        <span class="fa-stack fa-2x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fab fa-instagram fa-stack-1x fa-inverse" ></i>
                        </span></a><br>
                        <h3>Horarios de Atencion:</h3><br>
                        Lunes: 07:00 a. m. – 03:00 p. m.<br>
                        Martes: 07:00 a. m. – 03:00 p. m.<br>
                        Miercoles: 07:00 a. m. – 03:00 p. m.<br>
                        Jueves: 07:00 a. m. – 03:00 p. m.<br>
                        Viernes: 07:00 a. m. – 03:00 p. m.<br>
                        Sabados: 07:00 a. m. – 03:00 p. m.<br>
                        Domingos: 07:00 a. m. – 03:00 p. m.<br><br>
                        Efectivo, Transferencia Electrónica, Depósito Bancario
                        Colombia- Santander- (Bucarmanga, Floridablanca, Piedecuesta y Giron)
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="h3">Misión</div>
                    <div class="p"> Ser, más que una empresa, un aliado estratégico para nuestros clientes en la venta de frutas y verduras.</div>
                    <br>
                    <div class="h3">Visión</div>
                    Convertirnos, en un periodo de 3 años, en referentes en la industria de la comercialización de alimentos en Colombia.
                    <br><br>
                    <div class="h3">Valores</div>
                    <ul class="text-left">
                        <li>Compromiso</li>
                        <li>Perseverancia</li>
                        <li>Objetividad</li>
                        <li>Colaboración</li>
                    </ul> 
                    
                    
                    
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Portfolio Grid-->
    <section class="page-section" id="gallery">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Productos destacads</h2>
                <h3 class="section-subheading text-muted">Nuestros productos son de la mejor calidad.</h3>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModal1">
                            <img class="img-fluid" src="assets\fruver-img\COMPRA DESDE CASA - FRUVER AMB.jpg" alt="" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModal2">
                            <img class="img-fluid" src="assets\fruver-img\DEL CAMPO A TU CASA - FRUVER AMB.jpg" alt="" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModal3">
                            <img class="img-fluid" src="assets\fruver-img\DESCUENTO  - FRUVER AMB.jpg" alt="" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModal4">
                            <img class="img-fluid" src="assets\fruver-img\EXCELENTE CALIDAD - FRUVER AMB.jpg" alt="" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4 mb-sm-0">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModal5">
                            <img class="img-fluid" src="assets\fruver-img\MEERCA EN CASA - FRUVER AMB.jpg" alt="" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-toggle="modal" href="#portfolioModal6">
                            <img class="img-fluid" src="assets/img/portfolio/06-thumbnail.jpg" alt="" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact-->
    <section class="page-section" id="contact">
        <inbox-component></inbox-component>
    </section>
    <!-- Portfolio Modals-->
        <!-- Modal 1-->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <h2 class="text-uppercase">Compra desde casa</h2>
                                    <img class="img-fluid d-block mx-auto" src="assets\fruver-img\COMPRA DESDE CASA - FRUVER AMB.jpg" alt="" />
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Cerrar ventana
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal 2-->
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <h2 class="text-uppercase">Del campo a tu casa</h2>
                                    <img class="img-fluid d-block mx-auto" src="DEL CAMPO A TU CASA - FRUVER AMB.jpg" alt="" />
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal 3-->
        <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/03-full.jpg" alt="" />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>Date: January 2020</li>
                                        <li>Client: Finish</li>
                                        <li>Category: Identity</li>
                                    </ul>
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal 4-->
        <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/04-full.jpg" alt="" />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>Date: January 2020</li>
                                        <li>Client: Lines</li>
                                        <li>Category: Branding</li>
                                    </ul>
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal 5-->
        <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/05-full.jpg" alt="" />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>Date: January 2020</li>
                                        <li>Client: Southwest</li>
                                        <li>Category: Website Design</li>
                                    </ul>
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal 6-->
        <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/06-full.jpg" alt="" />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>Date: January 2020</li>
                                        <li>Client: Window</li>
                                        <li>Category: Photography</li>
                                    </ul>
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection