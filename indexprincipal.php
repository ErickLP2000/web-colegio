<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <meta charset="UTF-8">
  <title>Página principal</title>
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

  <style> /* Estilos generales del formulario */ .form-container { max-width: 600px; margin: 0 auto; } .form-group { margin-bottom: 15px; } .form-control { width: 100%; padding: 10px; box-sizing: border-box; } .form-control-small { width: auto; display: inline-block; } .btn-primary { background-color: #007bff; border: none; color: white; padding: 10px 20px; cursor: pointer; } .btn-primary:hover { background-color: #0056b3; } .success-message { display: none; color: green; font-weight: bold; margin-top: 20px; } </style>

  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <style> .success-message { display: none; color: green; background-color: #d4edda; padding: 10px; border: 1px solid #c3e6cb; border-radius: 5px; margin-top: 20px; } .success-message.show { display: block; } </style>
  <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

  

    
     <!-- JavaScript Functions -->
     <script>
        // Función para permitir sólo números en los campos de entrada
        function allowOnlyNumbers(event) {
            var charCode = event.which ? event.which : event.keyCode;
            if (charCode < 48 || charCode > 57) {
                event.preventDefault();
            }
        }
        
        // Función para permitir sólo letras con acentos, virgulilla y diacríticos
        function allowOnlyLetters(event) {
            var charCode = event.which ? event.which : event.keyCode;
            var pattern = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/;
            var char = String.fromCharCode(charCode);
            if (!pattern.test(char)) {
                event.preventDefault();
            }
        }

        // Validación adicional de formulario
        function validateForm(event) {
            var isValid = true;
            var correoInput = document.getElementById('correo_apoderado');
            var regexCorreo = /^[a-zA-ZñÑ0-9._%+-]+@[a-zA-ZñÑ0-9.-]+\.[a-zA-ZñÑ]{2,}$/;
            if (!regexCorreo.test(correoInput.value)) {
                isValid = false;
                correoInput.setCustomValidity("Correo electrónico no es válido");
                correoInput.reportValidity();
            } else {
                correoInput.setCustomValidity("");
            }

            var dniInput = document.getElementById('dni_apoderado');
            if (!/^\d{8}$/.test(dniInput.value)) {
                isValid = false;
                dniInput.setCustomValidity("DNI debe contener 8 dígitos");
                dniInput.reportValidity();
            } else {
                dniInput.setCustomValidity("");
            }

            var telefonoInput = document.getElementById('telefono_apoderado');
            if (!/^\d{9}$/.test(telefonoInput.value)) {
                isValid = false;
                telefonoInput.setCustomValidity("Teléfono debe contener 9 dígitos");
                telefonoInput.reportValidity();
            } else {
                telefonoInput.setCustomValidity("");
            }

            var textoInputs = document.querySelectorAll(
                'input[type="text"]:not(#telefono_apoderado):not(#dni_apoderado):not(#direccion_apoderado):not(#correo_apoderado):not(#correo_estudiante):not(#dni_estudiante)'
            );
            textoInputs.forEach(function(input) {
                var regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/;
                if (!regex.test(input.value)) {
                    isValid = false;
                    input.setCustomValidity(input.getAttribute('placeholder') + " debe contener solo letras y espacios");
                    input.reportValidity();
                } else {
                    input.setCustomValidity("");
                }
            });

            if (!isValid) {
                event.preventDefault();
            }
        }

        // Mostrar el mensaje de éxito si existe el parámetro en la URL
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('registro') === 'exitoso') {
                document.getElementById('successMessage').classList.add('show');
                // Eliminar el parámetro 'registro' de la URL
                const url = new URL(window.location);
                url.searchParams.delete('registro');
                window.history.replaceState({}, document.title, url);
            }
        };
    </script>

</head>

<body data-spy="scroll" data-target=".navbar-collapse">
  <!-- Navbar -->
  <nav class="navbar navbar-default navbar-fixed black no-background bootsnav">
    <div class="container">
        <!-- Encabezado de la barra de navegación -->
        <div class="navbar-header">
            <!-- Logo (opcional) -->
            <!--<a class="navbar-brand" href="#">
                <img src="assets/images/insignia.png" alt="Logo" style="max-height: 40px;">
            </a>-->
            <!-- Botón de colapso para pantallas pequeñas -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                <i class="fa fa-bars"></i>
            </button>
        </div>

        <!-- Menú de navegación -->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">
                <li><a href="#contact">Contacto</a></li>
                <li><a href="#hello">Inicio</a></li>
                <li><a href="#about">Sobre nosotros</a></li>
                <li><a href="#service">Servicios</a></li>
            </ul>

            <!-- Opciones de logueo alineadas a la derecha -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown">Iniciar Sesión <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="indexestudianteapoderado.php">Logueo Alumno</a></li>
                        <li><a href="index.php">Logueo Personal</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
  </nav>
  <section id="contact" class="about roomy-100">
        <div class="container">
            <div class="row">
                <div class="main_about">
                    <div class="col-md-6">
                        <div class="about_content">
                            <h2>Ratificación Admisión</h2>
                            <h1>2025</h1>
                            <div class="separator_left"></div>
                            <p>¡Bienvenidos a nuestra plataforma de matrícula en línea! Regístrate ahora y recibe toda la información necesaria para inscribir a tu hijo/a en nuestro prestigioso colegio. Una vez completado el formulario, nuestro equipo se pondrá en contacto contigo en pocas horas para confirmar la matrícula y enviarte las instrucciones de pago a tu correo electrónico. ¡No pierdas esta oportunidad de asegurar un futuro brillante para tu hijo/a con nosotros!</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form id="matricula-form" action="procesar_formulario.php" method="post" onsubmit="validateForm(event)">
                            <div class="form-container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombreapellido_apoderado">Nombre y apellido del apoderado</label>
                                            <input type="text" name="nombreapellido_apoderado" id="nombreapellido_apoderado" class="form-control"
                                                placeholder="Nombre y apellido apoderado" required maxlength="100" onkeypress="allowOnlyLetters(event)"
                                                title="Solo letras y espacios">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dni_apoderado">DNI del apoderado</label>
                                            <input type="text" name="dni_apoderado" id="dni_apoderado" class="form-control" placeholder="DNI"
                                                required maxlength="8" onkeypress="allowOnlyNumbers(event)" title="Debe contener 8 dígitos">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="direccion_apoderado">Dirección del apoderado</label>
                                            <input type="text" name="direccion_apoderado" id="direccion_apoderado" class="form-control"
                                                placeholder="Dirección" required maxlength="100">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono_apoderado">Celular del apoderado</label>
                                            <input type="text" name="telefono_apoderado" id="telefono_apoderado" class="form-control"
                                                placeholder="Número de celular" required maxlength="9" onkeypress="allowOnlyNumbers(event)"
                                                title="Debe contener 9 dígitos">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="correo_apoderado">Correo del apoderado</label>
                                    <input type="text" name="correo_apoderado" id="correo_apoderado" class="form-control" placeholder="Correo" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombreapellido_estudiante">Nombre y apellido del estudiante</label>
                                            <input type="text" name="nombreapellido_estudiante" id="nombreapellido_estudiante" class="form-control"
                                                placeholder="Nombre y apellido del estudiante" required maxlength="100" onkeypress="allowOnlyLetters(event)"
                                                title="Solo letras y espacios">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dni_estudiante">DNI del estudiante</label>
                                            <input type="text" name="dni_estudiante" id="dni_estudiante" class="form-control" placeholder="DNI"
                                                required maxlength="8" onkeypress="allowOnlyNumbers(event)" title="Debe contener 8 dígitos">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="fecha_nacimiento">Fecha de nacimiento del estudiante</label>
                                      <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" placeholder="Fecha de nacimiento" required title="Seleccione una fecha válida">
                                  </div>
                                </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="grado_estudiante">Grado del estudiante</label>
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
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
                                </div>
                            </div>
                        </form>
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
                        <img src="assets/images/insignia.png" class="logo logo-display m-top-10" alt="" style="padding: 3.5em;">
                    </a>
                    <h2 class="text-white" style="font-weight: bold; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);">Bienvenidos a Institución Educativa Virgen de Guadalupe, donde la excelencia académica y el desarrollo integral de nuestros estudiantes son nuestra prioridad</h2>
                </div>
                <div class="home_btns m-top-40 text-center">
                    <a href="index.php" class="btn btn-primary btn-lg m-top-20">Acceder a página principal</a>
                    <br>
                    <a href="indexestudianteapoderado.php" class="btn btn-primary btn-lg m-top-20">Acceso Estudiantes</a>
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

</body>

</html>
