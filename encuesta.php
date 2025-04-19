<?php
	include_once("./lib/dbEncuesta.php");
	include_once("./lib/dbDocente.php");
	include_once("./lib/dbEspacio_curricular.php");
	$enc = new Encuesta();
	$doc = new Docente();
	$esp_curr = new Espacio_curricular();
	
	$idEncuesta = $_GET["enc"];
	$enc->read($idEncuesta);
	$idDoc = $enc->get_docente();
	$doc->read($idDoc);
	$nombreDoc=$doc->get_nombre();
	$apellidoDoc=$doc->get_apellido();
	$idEsp_curr = $enc->get_espacio_curricular();
	$esp_curr->read($idEsp_curr);
	$nombreEsp_curr = $esp_curr->get_nombre();
	
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Encuesta a Estudiantes</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- nice select -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
  <!-- datepicker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <!-- funcionalida html -->
  <script src="visibilidad.js"></script>

</head>
<body class="sub_page">

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
        <div class="header_bottom">
          <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
              <a class="navbar-brand" href="http://www.agro.unc.edu.ar">
                <img src="./images/Logo FCA color.png" alt="logo FCA">
              </a>
  
  
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
              </button>
  
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="d-flex mr-auto flex-column flex-lg-row align-items-center">
                  <ul class="navbar-nav  ">
                    <li class="nav-item active">
                    <a class="nav-link" href="index.html"> <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="about.html"></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="treatment.html"></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="doctor.html"></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="testimonial.html"></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="contact.html"></a>
                    </li>
                  </ul>
                </div>
                </div>
              </div>
            </nav>
          </div>
        </div>
      </header>
    </div>
    <!-- end header section -->
    
<!-- Contact section -->
<div class="container mt-5">
  <h1 class="mb-4"><?php echo "Docente: " . $apellidoDoc . ", " . $nombreDoc;?></h1>
  <h2 class="mb-4"><?php echo "Espacio Curricular: " . $nombreEsp_curr;?></h2>
  <p clas="mb-4"><i>La presente encuesta es de carácter obligatorio y anónimo, según lo estipulado por el Honorable Consejo Superior (HCS) de la Universidad Nacional de Córdoba (UNC). Su respuesta es importante y necesaria para optimizar la calidad de la tarea docente en esta Facultad. MUCHAS GRACIAS</i></p>
  
  <!-- Condición de cursado -->
  <form id="form" action="agregar_respuesta.php" method="post">
	<input type="hidden" id="idEnc" name="idEnc" value="<?php echo $idEncuesta;?>">
	
    <div class="mb-3">
      <label for="condicion-cursado" class="form-label">1-Condición de cursado al momento de completar la encuesta:</label>
      <select id="condicion-cursado" name="condicion-cursado" class="form-select" required>
        <option value="">Selecciona una opción</option>
        <option>Promocional</option>
        <option>Regular</option>
        <option>Libre</option>
      </select>
    </div>

      <!-- Porcentaje de asistencia -->
    <div class="mb-3">
        <label for="asistencia" class="form-label">2-¿Qué porcentaje de asistencia tuviste en esta asignatura con este/a docente?</label>
        <select id="asistencia" name="asistencia" class="form-select" required>
            <option value="">Selecciona una opción</option>
            <option>Más del 75%</option>
            <option>Entre el 50% y 75%</option>
            <option>Entre el 25% y 50%</option>
            <option>Menos del 25%</option>
        </select>
    </div>

    <!-- La/el docente pertenece a la comisión -->
    <div class="mb-3">
        <label class="form-label">3-¿La/el docente corresponde a la comisión en la que cursaste la asignatura?</label>
        <div>
            <input type="radio" id="docente-si" name="docente-comision" value="Si" required  onclick="mostrarSection()">
            <label for="docente-si">Sí</label>
            <input type="radio" id="docente-no" name="docente-comision" value="No" onclick="mostrarSection()">
            <label for="docente-no">No</label>
        </div>
    </div>

    <!-- Tipo de clases desarrolladas -->
    <fieldset id="one-section">
        <div class="mb-3">
			<!-- Comentarios adicionales -->
            <label class="form-label">4-¿Qué tipo de clases desarrolló la/el docente? (puedes marcar más de una opción):</label>
            <div>
                <input type="checkbox" id="teoricas" name="teoricas" value="Solo teóricas">
                <label for="teoricas">Solo teóricas</label><br>
                <input type="checkbox" id="practicas" name="practicas" value="Solo prácticas">
                <label for="practicas">Solo prácticas</label><br>
                <input type="checkbox" id="teorico-practicas" name="teorico-practicas" value="Teórico-prácticas">
                <label for="teorico-practicas">Teórico-prácticas</label><br>
                <input type="checkbox" id="otras" name="otras" value="Otras">
                <label for="otras">Otras (ej. Talleres, módulos, seminarios, etc.)</label>
                <textarea id="otras-texto" name="otras-texto" class="form-control" rows="4" placeholder="Escribe aquí las otras clases que desarrollo el docente."></textarea>
            </div>
        </div>
    </fieldset>
    <fieldset id="extra-section">
        <!-- Calificación -->
        <div class="mb-3">
            <label for="asistencia-docente" class="form-label">5-La/el docente tuvo a su cargo el desarrollo de: </label>
            <select id="asistencia-docente" name="asistencia-docente" class="form-select" required>
				<option value="">Selecciona una opción</option>
                <option>Todas las clases </option>
                <option>Más de 2 clases </option>
                <option>Menos de 2 clases</option>
            </select>
        </div>
    
		<!-- Frecuencia de comportamientos docentes -->
        <table class="table">
			<tr>
                <th colspan="2">Indica con qué frecuencia la/el docente mostró los siguientes comportamientos frente a sus estudiantes:</th>
            </tr>
            <tr>
                <td>Permitió y respetó opiniones:</td>
                <td>
                    <select class="form-select" id="opiniones" name="opiniones" required>
                        <option value="">Selecciona una opción</option>
                        <option>Casi siempre</option>
                        <option>Frecuentemente</option>
                        <option>Con poca frecuencia</option>
                        <option>Casi nunca</option>
                        <option>No sabe / No contesta</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Manifestó buena disposición al responder dudas:</td>
                <td>
                    <select class="form-select" id="disposicion" name="disposicion" required>
                        <option value="">Selecciona una opción</option>
                        <option>Casi siempre</option>
                        <option>Frecuentemente</option>
                        <option>Con poca frecuencia</option>
                        <option>Casi nunca</option>
                        <option>No sabe / No contesta</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Fue respetuoso/a en el trato (clases, consultas, evaluaciones):</td>
                <td>
                    <select class="form-select" id="respetuoso" name="respetuoso" required>
                        <option value="">Selecciona una opción</option>
                        <option>Casi siempre</option>
                        <option>Frecuentemente</option>
                        <option>Con poca frecuencia</option>
                        <option>Casi nunca</option>
                        <option>No sabe / No contesta</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>La/el docente manifestó interés al llevar a cabo sus tareas (clases, consultas, evaluaciones):</td>
                <td>
                    <select class="form-select" id="interes" name="interes" required>
                        <option value="">Selecciona una opción</option>
                        <option>Casi siempre</option>
                        <option>Frecuentemente</option>
                        <option>Con poca frecuencia</option>
                        <option>Casi nunca</option>
                        <option>No sabe / No contesta</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Brindó apoyo y/o contención a sus estudiantes:</td>
                <td>
                    <select class="form-select" id="contencion" name="contencion" required>
                        <option value="">Selecciona una opción</option>
                        <option>Casi siempre</option>
                        <option>Frecuentemente</option>
                        <option>Con poca frecuencia</option>
                        <option>Casi nunca</option>
                        <option>No sabe / No contesta</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Atendió sus horarios de consulta:</td>
                <td>
                    <select class="form-select" id="consultas" name="consultas" required>
                        <option value="">Selecciona una opción</option>
                        <option>Casi siempre</option>
                        <option>Frecuentemente</option>
                        <option>Con poca frecuencia</option>
                        <option>Casi nunca</option>
                        <option>No sabe / No contesta</option>
                        <option>No asistí a su consulta</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Los criterios de evaluación fueron explicitados/comunicados:</td>
                <td>
                    <select class="form-select" id="criterios-evaluacion" name="criterios-evaluacion" required>
                        <option value="">Selecciona una opción</option>
                        <option>Casi siempre</option>
                        <option>Frecuentemente</option>
                        <option>Con poca frecuencia</option>
                        <option>Casi nunca</option>
                        <option>No sabe / No contesta</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>La devolución de las correcciones de trabajos y/o evaluaciones fueron claras:</td>
                <td>
                    <select class="form-select" id="correcciones-claras" name="correcciones-claras" required>
                        <option value="">Selecciona una opción</option>
                        <option>Casi siempre</option>
                        <option>Frecuentemente</option>
                        <option>Con poca frecuencia</option>
                        <option>Casi nunca</option>
                        <option>No sabe / No contesta</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>El/la docente utilizó los canales de comunicación que se acordaron:</td>
                <td>
                    <select class="form-select" id="comunicacion" name="comunicacion" required>
                        <option value="">Selecciona una opción</option>
                        <option>Casi siempre</option>
                        <option>Frecuentemente</option>
                        <option>Con poca frecuencia</option>
                        <option>Casi nunca</option>
                        <option>No sabe / No contesta</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Indicó las normas de higiene y seguridad para el desarrollo de las clases:</td>
                <td>
                    <select class="form-select" id="higiene-seguridad" name="higiene-seguridad" required>
                        <option value="">Selecciona una opción</option>
                        <option>Casi siempre</option>
                        <option>Frecuentemente</option>
                        <option>Con poca frecuencia</option>
                        <option>Casi nunca</option>
                        <option>No sabe / No contesta</option>
                    </select>
                </td>
            </tr>
          </table>
          <table class="table">
            <tr>
                <th colspan="2">Particularmente en sus clases, la/el docente:</th>
            </tr>
            <tr>
                <td>Explicó con claridad las temáticas:</td>
                <td>
                  <select class="form-select" id="claridad" name="claridad" required>
                    <option value="">Selecciona una opción</option>
                    <option>Casi siempre</option>
                    <option>Frecuentemente</option>
                    <option>Con poca frecuencia</option>
                    <option>Casi nunca</option>
                    <option>No sabe / No contesta</option>
                  </select>
                </td>
            </tr>
            <tr>
                <td>Propuso ejemplos y/o ejercicios relacionados con la vida real y/o profesional (contexto actual):</td>
                <td>
                  <select class="form-select" id="ejemplos" name="ejemplos" required>
                    <option value="">Selecciona una opción</option>
                    <option>Casi siempre</option>
                    <option>Frecuentemente</option>
                    <option>Con poca frecuencia</option>
                    <option>Casi nunca</option>
                    <option>No sabe / No contesta</option>
                  </select>
                </td>
            </tr>
            <tr>
                <td>Relacionó los temas nuevos con los anteriores (con otras asignaturas y/u otras unidades):</td>
                <td>
                  <select class="form-select" id="relacion-temas" name="relacion-temas" required>
                    <option value="">Selecciona una opción</option>
                    <option>Casi siempre</option>
                    <option>Frecuentemente</option>
                    <option>Con poca frecuencia</option>
                    <option>Casi nunca</option>
                    <option>No sabe / No contesta</option>
                  </select>
                </td>
            </tr>
            <tr>
                <td>Utilizó materiales de apoyo o complementarios para desarrollar las clases:</td>
                <td>
                  <select class="form-select" id="materiales-apoyo" name="materiales-apoyo" required>
                    <option value="">Selecciona una opción</option>
                    <option>Casi siempre</option>
                    <option>Frecuentemente</option>
                    <option>Con poca frecuencia</option>
                    <option>Casi nunca</option>
                    <option>No sabe / No contesta</option>
                  </select>
                </td>
            </tr>
            <tr>
                <td>Los materiales de apoyo o complementarios tuvieron adecuada organización y presentación:</td>
                <td>
                  <select class="form-select" id="organizacion-materiales" name="organizacion-materiales" required>
                    <option value="">Selecciona una opción</option>
                    <option>Casi siempre</option>
                    <option>Frecuentemente</option>
                    <option>Con poca frecuencia</option>
                    <option>Casi nunca</option>
                    <option>No sabe / No contesta</option>
                  </select>
                </td>
            </tr>
            <tr>
                <td>Sus exposiciones/explicaciones (teóricas/teórico-prácticas/prácticas) aportaron a una mejor comprensión de los conceptos desarrollados en la clase y/o bibliografía:</td>
                <td>
                  <select class="form-select" id="exposiciones" name="exposiciones" required>
                    <option value="">Selecciona una opción</option>
                    <option>Casi siempre</option>
                    <option>Frecuentemente</option>
                    <option>Con poca frecuencia</option>
                    <option>Casi nunca</option>
                    <option>No sabe / No contesta</option>
                  </select>
                </td>
            </tr>
            <tr>
                <td>Mediante las actividades prácticas mostró la utilidad o aplicación de la teoría:</td>
                <td>
                  <select class="form-select" id="actividades-practicas" name="actividades-practicas" required>
                    <option value="">Selecciona una opción</option>
                    <option>Casi siempre</option>
                    <option>Frecuentemente</option>
                    <option>Con poca frecuencia</option>
                    <option>Casi nunca</option>
                    <option>No sabe / No contesta</option>
                  </select>
                </td>
            </tr>
            <tr>
                <td>Todos los temas evaluados fueron dados en clases (teóricas/teórico-prácticas/prácticas) u otros espacios de aprendizaje propuestos por el espacio curricular:</td>
                <td>
                  <select class="form-select" id="temas-evaluados" name="temas-evaluados" required>
                    <option value="">Selecciona una opción</option>
                    <option>Casi siempre</option>
                    <option>Frecuentemente</option>
                    <option>Con poca frecuencia</option>
                    <option>Casi nunca</option>
                    <option>No sabe / No contesta</option>
                  </select>
                </td>
            </tr>
            <tr>
              <td>Promovió el pensamiento crítico (reflexión, análisis):</td>
              <td>
                  <select class="form-select" id="pensamiento-critico" name="pensamiento-critico" required>
                    <option value="">Selecciona una opción</option>
                    <option>Casi siempre</option>
                    <option>Frecuentemente</option>
                    <option>Con poca frecuencia</option>
                    <option>Casi nunca</option>
                    <option>No sabe / No contesta</option>
                  </select>
              </td>
            </tr>
            <tr>
              <td>Promovió el trabajo autónomo:</td>
              <td>
                  <select class="form-select" id="autonomia" name="autonomia" required>
                    <option value="">Selecciona una opción</option>
                    <option>Casi siempre</option>
                    <option>Frecuentemente</option>
                    <option>Con poca frecuencia</option>
                    <option>Casi nunca</option>
                    <option>No sabe / No contesta</option>
                  </select>
              </td>
            </tr>
            <tr>
              <td>Promovió el trabajo en equipo de manera colaborativa:</td>
              <td>
                  <select class="form-select" id="equipo" name="equipo" required>
                    <option value="">Selecciona una opción</option>
                    <option>Casi siempre</option>
                    <option>Frecuentemente</option>
                    <option>Con poca frecuencia</option>
                    <option>Casi nunca</option>
                    <option>No sabe / No contesta</option>
                  </select>
              </td>
            </tr>
            <tr>
              <td>Impulsó la participación de sus estudiantes para el intercambio de ideas:</td>
              <td>
                  <select class="form-select" id="participacion" name="participacion" required>
                    <option value="">Selecciona una opción</option>
                    <option>Casi siempre</option>
                    <option>Frecuentemente</option>
                    <option>Con poca frecuencia</option>
                    <option>Casi nunca</option>
                    <option>No sabe / No contesta</option>
                  </select>
              </td>
            </tr>
            <tr>
              <td>Motivó a participar en diferentes instancias de formación (talleres, jornadas, intercambios estudiantiles, cursos extracurriculares, etc.):</td>
              <td>
                  <select class="form-select" id="formacion" name="formacion" required>
                    <option value="">Selecciona una opción</option>
                    <option>Casi siempre</option>
                    <option>Frecuentemente</option>
                    <option>Con poca frecuencia</option>
                    <option>Casi nunca</option>
                    <option>No sabe / No contesta</option>
                  </select>
              </td>
            </tr>
          <tr>
            <td>Indica si consideras que este espacio curricular (asignatura, módulo, seminario, entre otros) aportó a tu formación:</td>
            <td>
                <select class="form-select" id="aporte" name="aporte" required>
                    <option value="">Selecciona una opción</option>
                    <option>Casi siempre</option>
                    <option>Frecuentemente</option>
                    <option>Con poca frecuencia</option>
                    <option>Casi nunca</option>
                    <option>No sabe / No contesta</option>
                </select>
            </td>
          </tr>
          <tr>
		    <td colspan="2">
                <div class="pregunta">
                    <p>¿Por qué?</p>
                    <textarea id="respuestaPorQue" name="respuestaPorQue" rows="4" cols="50" placeholder="Escribe tu respuesta aquí..."></textarea>
                </div>
            </td>
          </tr>
		</table>
        
		<!-- Valoración del docente -->
        <div class="mb-3">
			<label for="valoracion-docente" class="form-label">Utilizando la escala propuesta, ingresa el puntaje con el que calificarías en forma global a la/el docente</label>
            <select id="valoracion-docente" name="valoracion-docente" class="form-select" required>
              <option value="">Selecciona una opción</option>
			  <option>10 (Sobresaliente)</option>
              <option>9 (Distinguido)</option>
              <option>8 - 7 (Muy Bueno)</option>
              <option>6 - 5 (Bueno)</option>
              <option>4 (Suficiente)</option>
              <option>3 - 2 - 1 (Insuficiente)</option>
            </select>
        </div>
		<!-- Comentarios adicionales -->
		<div class="mb-3">
			<label for="comentarios" class="form-label">En este espacio puedes comunicar observaciones que le parezcan pertinentes, sobre aspectos del desempeño docente que estén considerados, o no considerados, en esta encuesta (no es obligatorio contestar):</label>
			<textarea id="comentarios" name="comentarios" class="form-control" rows="4" placeholder="Escribe aquí tus observaciones (opcional)"></textarea>
		</div>
		<button type="submit" class="btn btn-success">Enviar Encuesta</button>
    </fieldset>
	<div>
		<label id="no-corresponde" style="display: none;" ><strong>En ese caso, no corresponde que contestes la encuesta. Puedes buscar en el aula virtual la encuesta del/la docente con quien tuviste clases, o puedes comunicarte con el equipo docente del espacio curricular para acceder a la encuesta correcta. Desde ya, muchas gracias.</strong></label>
	</div>
    </form>
	<br>
</div>

    <!-- end contact section -->
      <!-- info section -->
  <section class="info_section ">
    <div class="container">
      <div class="info_bottom layout_padding2">
        <div class="row info_main_row">
          <div class="col-md-6 col-lg-3">
            <div class="info_contact">
              <a href="http://www.agro.unc.edu.ar">
                <i aria-hidden="true"></i>
                <span>
                 Universidad Nacional de Córdoba <br> Facultad de Ciencias Agropecuarias
                </span>
              </a>
			  <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Ing. Agr. Félix Aldo Marrone 746
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  (351) 5353788
                </span>
              </a>
              <a href="">
                <i class="far fa address-book"></i>
                <span>
                  Ciudad Universitaria
                </span>
              </a>
              <a href="">
                <i class="far fa address-book"></i>
                <span>
                  Córdoba - Argentina
                </span>
              </a>
            </div>
            <div class="social_box">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-youtube" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
            </div>
          </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end info_section -->




  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> 2024
        <a href="https://html.design/">Free Html Templates</a>
      </p>
    </div>
  </footer>
  <!-- footer section -->



  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <!-- datepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>

</body>
</html>
