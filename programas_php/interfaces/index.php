<!DOCTYPE HTML>
<html>
<head>
 <meta charset="utf-8">
    <title>Sistema de monitoreo</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', Arial, sans-serif;
      background-color: #FFFFFF;
      margin: 0;
      padding: 0;
    }
    
    #header {
      background-color: #1F618D;
      text-align: center;
      padding: 20px;
    }
    
    #header img {
      max-width: 100%;
      height: auto;
    }
    
    #content {
      background-color: #D4E6F1;
      display: flex;
      justify-content: space-between;
      margin: 20px;
      padding: 20px;
      border-radius: 10px;
    }
    
    #sidebar {
      width: 30%;
      background-color: #1F618D;
      color: white;
      padding: 20px;
      border-radius: 10px;
    }
    
    #sidebar h2 {
      margin: 0;
      font-size: 24px;
      margin-bottom: 20px;
      text-align: center;
      font-weight: bold;
    }
    
    #sidebar form {
      margin-bottom: 20px;
    }
    
    #sidebar label {
      display: block;
      color: white;
      font-weight: bold;
      margin-bottom: 10px;
    }
    
    #sidebar input[type="text"],
    #sidebar input[type="password"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border-radius: 5px;
      border: none;
    }
    
    #sidebar input[type="submit"] {
      background-color: #2980B9;
      color: white;
      padding: 8px 20px;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      font-weight: bold;
    }
    
    #sidebar input[type="submit"]:hover {
      background-color: #1F618D;
    }
    
    #error-message {
      background-color: #FFDDDD;
      color: #FF0000;
      font-weight: bold;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 5px;
    }
    
    #content-container {
      width: 65%;
      border-radius: 10px;
      background-color: #FFFFFF;
      padding: 20px;
    }
    
    #content h2 {
      font-size: 24px;
      margin-top: 0;
      margin-bottom: 10px;
      font-weight: bold;
    }
    
    #content p {
      line-height: 1.5;
      margin-bottom: 10px;
    }
    
    #content ul {
      margin-bottom: 10px;
      padding-left: 20px;
    }
    
    #content ul li {
      margin-bottom: 5px;
    }
    
    .logo-container {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
    }
    
    .logo-container img {
      max-width: 100%;
      height: auto;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
  </style>
</head>
<body>
  <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-lg-5">
            
        </div>
        <div class="row py-3 px-lg-5">
            <div class="col-lg-4">
                <a href="" class="navbar-brand d-none d-lg-block">
                    <img class="logo" src="logo.jpeg" alt="Logo de la empresa" style="width: 200px; height: auto;">
                </a>
            </div>
            <div class="col-lg-8 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="d-inline-flex flex-column text-center pr-3 border-right">
                        <h6>Horas de atencion</h6>
                        <p class="m-0">8.00AM - 9.00PM</p>
                    </div>
                    <div class="d-inline-flex flex-column text-center px-3 border-right">
                        <h6>Correo electronico</h6>
                        <p class="m-0">info@monitoreoSatelital.com</p>
                    </div>
                    <div class="d-inline-flex flex-column text-center pl-3">
                        <h6>Llamanos</h6>
                        <p class="m-0">+57 3105192099</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->
    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5">
            <a href="" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-capitalize font-italic text-white"><span class="text-primary">Safety</span>First</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="https://invernaderom.000webhostapp.com/" class="nav-item nav-link active">Home</a>
                    <a href="about.html" class="nav-item nav-link">Sobre nosotros</a>
                    <a href="service.html" class="nav-item nav-link">Servicios</a>
                    <a href="price.html" class="nav-item nav-link">Precios</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Paginas</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="blog.html" class="dropdown-item">Blog Grid</a>
                            <a href="single.html" class="dropdown-item">Blog Detail</a>
                        </div>
                    </div>
                    <a href="contact.html" class="nav-item nav-link">Contact</a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->
  
  <div id="content">
    <div id="content-container">
      <h2>Descripción del Sistema</h2>
      <p>
        Nuestro prototipo de Sistema de Seguridad para Vehículo Particular es una solución avanzada diseñada para brindar una protección completa a su vehículo y garantizar la seguridad de su propiedad. Mediante la integración de tecnología de vanguardia y características innovadoras, nuestro sistema se enfoca en prevenir robos, detectar intrusiones y proporcionar alertas en tiempo real para mantener su vehículo a salvo en todo momento.
      </p>
      
      <h2>Servicios</h2>
      <ul>
        <li>Localización y seguimiento GPS.</li>
        <li>Notificaciones y alertas.</li>
        <li>Geocerca y notificaciones de entrada/salida.</li>
        <li>Integración con sistemas de monitoreo centralizado.</li>
      </ul>
      
      <h2>¿Quiénes Somos?</h2>
      <p>
        Somos un equipo de expertos apasionados por la seguridad y protección vehicular. Nuestro objetivo es el compromiso con la mejora constante y la investigación y desarrollo continuos para seguir ofreciendo soluciones de seguridad innovadoras y adaptadas a las necesidades cambiantes de nuestros clientes. Confíe en nosotros para proteger su vehículo y brindarle la tranquilidad que se merece en cada viaje que realice.
      </p>
    </div>
    
    <div id="sidebar">
      <h2>Ingreso de Usuarios</h2>
      <form method="POST" action="validar.php">
        <label for="login">Usuario:</label>
        <input type="text" id="login" name="login1" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="passwd1" required>
        
        <input type="submit" value="Enviar" name="Enviar">
      </form>
      
      <?php
      if (isset($_GET["mensaje"])) {
        $mensaje = $_GET["mensaje"];
        if ($_GET["mensaje"] != "") {
      ?>
          <div id="error-message">
            <u>Datos Incorrectos:</u><br>
            <?php
            if ($mensaje == 1)
              echo "El password del usuario no coincide.";
            if ($mensaje == 2)
              echo "No hay usuarios con el login (usuario) ingresado o está inactivo.";
            if ($mensaje == 3)
              echo "No se ha logueado en el Sistema. Por favor ingrese los datos.";
            if ($mensaje == 4)
              echo "Su tipo de usuario no tiene las credenciales suficientes para ingresar a esta opción.";
            ?>
          </div>
      <?php
        }
      }
      ?>
    </div>
  </div>
</body>
</html>
