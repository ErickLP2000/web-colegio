<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <meta charset="UTF-8">
  <title>Pagina principal</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="assets/images/insignia.png">

  <!--Google Font link-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/slick.css">
  <link rel="stylesheet" href="assets/css/slick-theme.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="assets/css/fonticons.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/magnific-popup.css">
  <link rel="stylesheet" href="assets/css/bootsnav.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
  .success-message {
    display: none;
    /* Oculto por defecto */
    padding: 20px;
    background-color: #4CAF50;
    /* Color verde */
    color: white;
    margin-bottom: 15px;
    text-align: center;
    border-radius: 4px;
  }

  .success-message.show {
    display: block;
    /* Mostrar cuando se agrega la clase 'show' */
  }

  /* Navbar ajustes */
  .navbar-header .navbar-brand img {
    width: 50px;
    /* Tamaño del logo */
  }
  </style>

  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/responsive.css">

  <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

  <script>
  // Función para permitir sólo números en los campos de entrada
  function allowOnlyNumbers(event) {
    var charCode = event.which ? event.which : event.keyCode;
    // Sólo admite números (0-9)
    if (charCode < 48 || charCode > 57) {
      event.preventDefault();
    }
  }

  // Función para permitir sólo letras con acentos, virgulilla y diacríticos
  function allowOnlyLetters(event) {
    var charCode = event.which ? event.which : event.keyCode;
    // Permitir letras (a-z, A-Z) con acento español y caracteres especiales
    var pattern = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/;
    var char = String.fromCharCode(charCode);
    if (!pattern.test(char)) {
      event.preventDefault();
    }
  }

  // Función para validar el correo electrónico
  function validateEmail(event) {
    const input = event.target.value;
    // Expresión regular actualizada para permitir caracteres especiales
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!emailPattern.test(input)) {
      event.target.setCustomValidity("Por favor, ingrese un correo electrónico válido.");
    } else {
      event.target.setCustomValidity("");
    }
  }
  </script>

</head>

<body data-spy="scroll" data-target=".navbar-collapse">
  <!-- Navbar -->
  <nav class="navbar navbar-default navbar-fixed black no-background bootsnav">
    <div class="container">
      <div class="navbar-header">
        <!-- Logo colocado dentro de navbar-header para alinearlo más a la izquierda -->

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
          <i class="fa fa-bars"></i>
        </button>
      </div>
      <div class="collapse navbar-collapse" id="navbar-menu">
        <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
          <li><a href="#contact">Contacto</a></li>
          <li><a href="#hello">Inicio</a></li>
          <li><a href="#about">Sobre nosotros</a></li>
          <li><a href="#service">Servicios</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Contacto -->
  <section id="contact" class="about roomy-100">
    <div class="container">
      <div class="row">
        <div class="main_about">
          <div class="col-md-6">
            <div class="about_content">
              <h2>Ratificación Admisión</h2>
              <h1>2025</h1>
              <div class="separator_left"></div>
              <p>¡Bienvenidos a nuestra plataforma de matrícula en línea!
                Regístrate ahora y recibe toda la información necesaria para inscribir a tu hijo/a en nuestro
                prestigioso colegio. Una vez completado el formulario, nuestro equipo se pondrá en contacto contigo en
                pocas horas para confirmar la matrícula y enviarte las instrucciones de pago a tu correo electrónico.
                ¡No pierdas esta oportunidad de asegurar un futuro brillante para tu hijo/a con nosotros!</p>
            </div>
          </div>
          <div class="col-md-6">
            <form id="matricula-form" action="procesar_formulario.php" method="post">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nombre_apoderado">Ingresar nombre del apoderado</label>
                    <input type="text" name="nombre_apoderado" id="nombre_apoderado" class="form-control"
                      placeholder="Nombre apoderado" required maxlength="50" onkeypress="allowOnlyLetters(event)"
                      title="Solo letras y espacios">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="apellido_apoderado">Ingresar apellido del apoderado</label>
                    <input type="text" name="apellido_apoderado" id="apellido_apoderado" class="form-control"
                      placeholder="Apellido apoderado" required maxlength="50" onkeypress="allowOnlyLetters(event)"
                      title="Solo letras y espacios">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="direccion_apoderado">Ingresar dirección del apoderado</label>
                    <input type="text" name="direccion_apoderado" id="direccion_apoderado" class="form-control"
                      placeholder="Dirección" required maxlength="100">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="telefono_apoderado">Ingresar celular del apoderado</label>
                    <input type="text" name="telefono_apoderado" id="telefono_apoderado" class="form-control"
                      placeholder="Número de celular" required maxlength="9" onkeypress="allowOnlyNumbers(event)"
                      title="Debe contener 9 dígitos">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="dni_apoderado">Ingresar DNI del apoderado</label>
                    <input type="text" name="dni_apoderado" id="dni_apoderado" class="form-control" placeholder="DNI"
                      required maxlength="8" onkeypress="allowOnlyNumbers(event)" title="Debe contener 8 dígitos">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nombre_estudiante">Ingresar nombre del estudiante</label>
                    <input type="text" name="nombre_estudiante" id="nombre_estudiante" class="form-control"
                      placeholder="Nombre del estudiante" required maxlength="50" onkeypress="allowOnlyLetters(event)"
                      title="Solo letras y espacios">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="apellido_estudiante">Ingresar apellidos del estudiante</label>
                    <input type="text" name="apellido_estudiante" id="apellido_estudiante" class="form-control"
                      placeholder="Apellidos del estudiante" required maxlength="50"
                      onkeypress="allowOnlyLetters(event)" title="Solo letras y espacios">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="correo_apoderado">Ingresar correo del apoderado</label>
                    <input type="email" name="correo_apoderado" id="correo_apoderado" class="form-control"
                      placeholder="Correo electrónico" required oninput="validateEmail(event)">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="grado_estudiante">Ingresar grado del estudiante</label>
                    <select name="grado_estudiante" id="grado_estudiante" class="form-control" required>
                      <option value="">Seleccione un grado</option>
                      <option value="1ero de primaria">1ero de primaria</option>
                      <option value="2do de primaria">2do de primaria</option>
                      <option value="3ro de primaria">3ro de primaria</option>
                      <option value="4to de primaria">4to de primaria</option>
                      <option value="5to de primaria">5to de primaria</option>
                      <option value="6to de primaria">6to de primaria</option>
                    </select>
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
                </div>
              </div>
            </form>
            <!-- Bloque del Mensaje de Éxito -->
            <div class="success-message" id="successMessage">Registro exitoso</div>
          </div>
        </div>
      </div>
    </div>
  </section>



  <br>
  <br>

  <br>

  <section id="hello" class="home bg-mega">
    <div class="container">
      <div class="row">
        <div class="main_home">
          <div class="home_text text-center">
            <!-- Agregar la imagen del logo -->
            <a href="#brand">
              <img src="assets/images/insignia.png" class="logo logo-display m-top-10" alt="">
            </a>
            <h2 class="text-white">Bienvenidos a Institución Educativa Virgen de Guadalupe, donde la excelencia
              académica y el desarrollo integral de nuestros estudiantes son nuestra prioridad</h2>
          </div>
          <div class="home_btns m-top-40 text-center">
            <a href="index.php" class="btn btn-primary m-top-20">Acceder a pagina principal</a>
          </div>
        </div>
      </div>
    </div>
  </section>




  <!-- Sobre Nosotros -->
  <section id="about" class="about roomy-100">
    <div class="container">
      <div class="row">
        <div class="main_about">
          <div class="col-md-6">
            <div class="about_content">
              <h2>Sobre nosotros</h2>
              <div class="separator_left"></div> <!-- Línea decorativa a la izquierda -->
              <p>Somos un colegio público del Callao comprometido con la educación integral de nuestros estudiantes.
                Nuestro objetivo es brindar una formación académica de excelencia y fomentar un ambiente inclusivo y
                acogedor para todos.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="about_accordion wow fadeIn">
              <div id="faq_main_content" class="faq_main_content">
                <h6><i class="fa fa-bullseye"></i> Misión</h6> <!-- Nuevo ícono de Misión -->
                <div>
                  <div class="content">
                    <p>Nuestra misión es proporcionar una educación de alta calidad que prepare a los estudiantes para
                      los desafíos del futuro. Nos esforzamos por integrar la tecnología en el aula para facilitar la
                      comunicación, la creatividad y el aprendizaje continuo.</p>
                  </div>
                </div>
                <h6 class="open"><i class="fa fa-eye"></i> Visión</h6> <!-- Nuevo ícono de Visión -->
                <div class="open">
                  <div class="content">
                    <p>Ser un colegio líder en el Callao reconocido por nuestra innovación educativa y nuestro
                      compromiso con el desarrollo integral de nuestros estudiantes. Aspiramos a crear un entorno donde
                      la tecnología y la educación trabajen juntas para empoderar a los niños y sus familias, asegurando
                      su éxito académico y personal.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- Servicios -->
  <section id="service" class="service roomy-100">
    <div class="container">
      <div class="row">
        <div class="main_service">
          <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
            <div class="head_title text-center">
              <h2>Servicios</h2>
              <div class="separator_auto"></div> <!-- Línea decorativa centrada -->
              <p>En nuestro colegio, nos comprometemos a ofrecer una educación integral y de calidad. Conoce los
                servicios que ponemos a tu disposición para garantizar el desarrollo completo de nuestros estudiantes.
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="service_item">
              <h3>Educación de Calidad</h3>
              <div class="separator_small"></div>
              <p>Brindamos un plan de estudios robusto y actualizado, diseñado para preparar a los estudiantes para los
                desafíos del futuro.</p>
              <!-- Imagen referencial -->
              <img src="assets/images/calidadd.jpg" class="img-responsive" alt="Educación de Calidad">
            </div>
          </div>
          <div class="col-md-4">
            <div class="service_item">
              <h3>Actividades Extracurriculares</h3>
              <div class="separator_small"></div>
              <p>Ofrecemos una amplia gama de actividades extracurriculares, desde deportes hasta artes, para fomentar
                el desarrollo de habilidades y talentos.</p>
              <!-- Imagen referencial -->
              <img src="assets/images/futbol.jpg" class="img-responsive" alt="Actividades Extracurriculares">
            </div>
          </div>
          <div class="col-md-4">
            <div class="service_item">
              <h3>Página Web Interactiva</h3>
              <div class="separator_small"></div>
              <p>Accede a nuestra página web para ver las notas, enviar tareas y mucho más. Diseñada para facilitar la
                comunicación entre estudiantes, padres y el colegio, ¡todo a un clic de distancia!</p>
              <!-- Imagen referencial -->
              <img src="assets/images/paginacole.jpeg" class="img-responsive" alt="Página Web Interactiva">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- Footer -->
  <footer id="footer" class="footer bg-black">
    <div class="container">
      <div class="main_footer text-center p-top-40 p-bottom-30">
        <a href="https://www.facebook.com/profile.php?id=100059036479616">Facebook Colegio</a>
        <p>Jr. Zarumilla s/n PPJJ Miguel Grau – Callao | ie5010callao@hotmail.com</p>
      </div>
    </div>
  </footer>

  <!-- JS Includes -->
  <script src="assets/js/vendor/jquery-1.11.2.min.js"></script>
  <script src="assets/js/vendor/bootstrap.min.js"></script>
  <script src="assets/js/jquery.magnific-popup.js"></script>
  <script src="assets/js/jquery.easing.1.3.js"></script>
  <script src="assets/js/slick.min.js"></script>
  <script src="assets/js/jquery.collapse.js"></script>
  <script src="assets/js/bootsnav.js"></script>
  <script src="assets/js/plugins.js"></script>
  <script src="assets/js/main.js"></script>

  <!-- Validaciones -->
  <script>
  // Mostrar el mensaje de éxito si existe el parámetro en la URL 
  window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('registro') === 'exitoso') {
      document.getElementById('successMessage').classList.add('show'); // Eliminar el parámetro 'registro' de la URL 
      const url = new URL(window.location);
      url.searchParams.delete('registro');
      window.history.replaceState({}, document.title, url);
    }
  };
  </script>

  <script>
  document.getElementById('matricula-form').addEventListener('submit', function(event) {
    var isValid = true;

    // Validar que solo se ingresen letras en campos de texto
    var textoInputs = document.querySelectorAll(
      'input[type="text"]:not(#telefono_apoderado):not(#dni_apoderado):not(#direccion_apoderado)');
    textoInputs.forEach(function(input) {
      var regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/;
      if (!regex.test(input.value)) {
        isValid = false;
        alert(input.getAttribute('placeholder') + " debe contener solo letras y espacios");
      }
    });

    // Validar DNI
    var dniInput = document.getElementById('dni_apoderado');
    if (!/^\d{8}$/.test(dniInput.value)) {
      isValid = false;
      alert("DNI debe contener 8 dígitos");
    }

    // Validar Teléfono
    var telefonoInput = document.getElementById('telefono_apoderado');
    if (!/^\d{9}$/.test(telefonoInput.value)) {
      isValid = false;
      alert("Teléfono debe contener 9 dígitos");
    }
    /* // Validar Correo Electrónico 
    var correoInput = document.getElementById('correo_apoderado');
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correoInput.value)) {
      isValid = false;
      alert("Correo electrónico no es válido");
    }
    if (!isValid) {
      event.preventDefault();
    } */
  });
  </script>




</body>

</html>