<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Beeset</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('/img/brand/favicon.png') }}" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="{{ asset('/img/brand/logo_putih.png') }}" alt="" /></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ml-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                        @if (Route::has('login'))
                                @auth
                                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ url('/home') }}">Home</a></li>
                                @else 
                                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('login') }}">Login</a></li>
                                    
                                @endauth
                                
                        @endif
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#services">Grafik Panen</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#portfolio">Peta</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">Cara Menggunakan</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#team">Tim Developer</a></li>
                      
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Selamat Datang di Beeset !</div>
                <div class="masthead-heading text-uppercase">Teknologi Kandang Lebah Madu Terintegrasi</div>
                <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Lebih Lanjut</a>
            </div>
        </header>
        <!-- Grafik-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Grafik Panen Lebah Madu Menggunakan Teknologi Beeset</h2>
                    <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
                </div>
                <div class="card mt-5">
                    <div id="Chart_2"></div>
                </div>
            </div>
        </section>
        <!-- Portfolio Grid-->
        <div class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Peta Persebaran Beeset</h2>
                    <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
                </div>
            </div>
        </div> 
        <div id="mapin" style="height:500px;"></div>
        <!-- About-->
        <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Bagaimana Cara Menggunakan Sistem ?</h2>
                    <h3 class="section-subheading text-muted">Langkah Mudah, Percepat Pengelolaan Untuk Hasil Yang Maksimal</h3>
                </div>
                <ul class="timeline">
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{asset('assets/img/about/1.jpg')}}" alt="" /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading">Daftarkan Kelompok Beserta Ketuanya</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Penanggungjawab membuat kelompok sekaligus menentukan ketua kelompoknya</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{asset('assets/img/about/2.jpg')}}" alt="" /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading">Daftarkan Peternak</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Pendaftaran melalui aplikasi android</p></div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{asset('assets/img/about/3.jpg')}}" alt="" /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                
                                <h4 class="subheading">Daftarkan Kandang Lebah Madu Terintegrasi</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Setelah peternak mendapat akses, daftarkan kandang agar bisa dikelola dan dipantau otomatis</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{asset('assets/img/about/4.jpg')}}" alt="" /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                
                                <h4 class="subheading">Konfigurasi Kandang Lebah Madu Terintegrasi</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Atur url thingspeak pada kandang</p></div>
                        </div>
                    </li>
                    <li>
                    <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{asset('assets/img/about/5.jpg')}}" alt="" /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                
                                <h4 class="subheading">Kelola Data Dan Pantau Peternak</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Pantau dan kelola performa kelompok, peternak dan kandang</p></div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <!-- Team-->
        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Tim Developer</h2>
                    <h3 class="section-subheading text-muted">Beeset Team</h3>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{asset('assets/img/team/1.jpg')}}" alt="" />
                            <h4>Abi Sarirayndra</h4>
                            <p class="text-muted">Web Programmer</p>
                            
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{asset('assets/img/team/2.jpg')}}" alt="" />
                            <h4>Dhimas Panji Sastra</h4>
                            <p class="text-muted">Android Programmer</p>
                            
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{asset('assets/img/team/3.jpg')}}" alt="" />
                            <h4>Mirta Jhoswanda</h4>
                            <p class="text-muted">Hardware Developer</p>
                            
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="{{asset('assets/img/team/4.jpg')}}" alt="" />
                            <h4>Riki Habibi</h4>
                            <p class="text-muted">Hardware Developer</p>
                           
                        </div>
                    </div>
                </div>
            
            </div>
        </section>
        <!-- Contact-->
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-left"></div>
                    <div class="col-lg-4 my-3 my-lg-0 text-lg-center" >
                    Copyright © Beeset Website 2020
                    </div>
                    <div class="col-lg-4 text-lg-right">
                       
                    </div>
                </div>
            </div>
        </footer>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Contact form JS-->
        <script src="{{asset('assets/mail/jqBootstrapValidation.js')}}"></script>
        <script src="{{asset('assets/mail/contact_me.js')}}"></script>
        <!-- Core theme JS-->
        <script src="{{asset('js/scripts.js')}}"></script>
        <script src="{{ asset('/js/highcharts.js')}}"></script>
        <script>
                Highcharts.setOptions({
                    colors: ['#fed136']
                });
                Highcharts.chart('Chart_2', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: ''
                    },
                    xAxis: {
                        categories: {!!json_encode($categories2)!!},
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Berat Panen Madu (Kg)'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:.1f} kg</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name: 'Panen ',
                        data: {!!json_encode($data2)!!},
                        // data: [1,2],

                    }]
                });
                
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC68gJT0BtgwM_Mc8jMmC7T4FuTQ6IhISc&callback=initMap" type="application/javascript"></script>


<!-- ============= Array ============= -->

    <script>
      var array =[];
    </script>

    @foreach ($maps as $map)

    <script type="text/javascript">
        //Memasukkan data tabel ke array
        array.push(['<?php echo $map->latitude?>','<?php echo $map->longitude?>','<?php echo $map->nama?>','<?php echo $map->peternak?>']);
    </script> 

    @endforeach
  
<!-- ============= Array ============= -->

<script>
     
      function initMap() {
        var bounds = new google.maps.LatLngBounds();
        var peta = new google.maps.Map(document.getElementById('mapin'), {
          center : {lat: -8.408698, lng: 114.2339090},
          zoom : 8.5
        });
        var infoWindow = new google.maps.InfoWindow(), marker, i;
        for (var i = 0; i < array.length; i++) {
          
          var position = new google.maps.LatLng(array[i][0],array[i][1]);
          bounds.extend(position);
          var marker = new google.maps.Marker({
            position : position,
            map : peta,
            icon : 'https://img.icons8.com/plasticine/40/000000/marker.png',
            
          });
          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              var infoWindowContent = 
              '<div class="content"><p>'+
              '<h2>'+array[i][2]+'</h2>'+
              'Pemilik : '+array[i][3]+'<br/>'+
              'Titik Koordinat : '+array[i][0]+', '+array[i][1]+'<br/>'+
              '</p></div>';
              infoWindow.setContent(infoWindowContent);
              infoWindow.open(peta, marker);
            }
          })(marker, i));
        }
       
      }
      
    </script>
    </body>
</html>
