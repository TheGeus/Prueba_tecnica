<?php
/**
 * requerimientos
 */
require '../funciones/filtrado.php';
/**
 * Datos server
 */
const CORREO = 'webmaster@example.com';
/**
 * PreWebinar
 */
const SUBJECT_INSCRIPCION = "Gracias por inscribirte";
const SUBJECT_RECORDATORIO_DIA_ANTES = "Recordatorio de asistencia al Webinar (1 día restante)";
const SUBJECT_RECORDATORIO_MINUTOS_ANTES = "Recordatorio de asistencia al Webinar (15 min restante)";

/**
 * PostWebinar
 */
const SUBJECT_AGRADECMIENTO_ASISTENCIA = "Gracias por asistir al Webinar";
const SUBJECT_TRAS_QUINCE_DIAS_LEAD_MAGNET_EVENTO = "Lead Magnet relacionados al evento";

/**
 * Mensaje Agradecimiento
 */
const AGRADECIMIENTO_INSCRIPCION = "<html>
<head>
  <title>Gracias por Inscribirte</title>
</head>
<body>
  <p>Información útil.!</p>
  <table>
    <tr>
      <th>Evento</th><th>Día</th><th>Mes</th><th>Año</th>
    </tr>
    <tr>
      <td>Webinar</td><td>17th</td><td>Agosto</td><td>2023</td>
    </tr>
  </table>
</body>
</html>";

if(isset($_POST['INSCRIPCION_GRACIAS'])){
    if(!empty($_POST['email'])){
        $correoDestino = filtrado($_POST['email']);
        $to      = $correoDestino;
        $subject = SUBJECT_INSCRIPCION;
        $message = AGRADECIMIENTO_INSCRIPCION;
        $headers = 'From: '.CORREO;

        mail($to, $subject, $message, $headers);
        echo "true";
    }else{
        echo "false";
    }
}