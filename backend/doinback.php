<?php
//Importar las clases de PHPMailer al espacio de nombres global
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Cargar el autocargador de Composer y filtrado
require '../vendor/autoload.php';
require '../funciones/filtrado.php';

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
const AGRADECIMIENTO_INSCRIPCION = "<p>Información útil.!</p>
          <table style=\"border: solid 1px\">
            <tr>
              <th style=\"border: solid 1px\">Evento</th><th style=\"border: solid 1px\">Día</th><th style=\"border: solid 1px\">Mes</th><th style=\"border: solid 1px\">Año</th>
            </tr>
           <tr>
        <td style=\"border: solid 1px\">Webinar</td><td style=\"border: solid 1px\">17th</td><td style=\"border: solid 1px\">Agosto</td><td style=\"border: solid 1px\">2023</td>
     </tr>
    </table>";

function mandarMail($correoDestino, $subject, $message, $messageTextoPlano){
    //Crear una instancia; pasar `true` habilita las excepciones
    $mail = new PHPMailer(true);
    
    try {
        //Ajustes del servidor
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Activar la salida de depuración verbosa
        $mail->isSMTP();                                            //Enviar mediante SMTP
        $mail->Host       = 'smtp.hostinger.com';                     //Configurar el servidor SMTP para enviar a través de
        $mail->SMTPAuth   = true;                                   //Activar la autenticación SMTP
        $mail->Username   = 'el email';                     //Nombre de usuario SMTP
        $mail->Password   = 'la clave';                               //SMTP contraseña
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Activar el cifrado implícito TLS
        $mail->Port       = 465;                                    //Puerto TCP al que conectarse; utilice 587 si ha establecido `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`.
    
        //Destinatario(s)
        $mail->setFrom('pruebatecnica@salvapiscinas.es', 'Prueba Tecnica');
        $mail->addAddress($correoDestino);               //El nombre es opcional
    
        //Contenido del mensaje
        $mail->isHTML(true);                                  //Establecer el formato del correo electrónico en HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = $messageTextoPlano;
    
        $mail->send();
        echo 'true';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
}


if(isset($_POST['INSCRIPCION_GRACIAS'])){
    if(!empty($_POST['email'])){
        $correoDestino = filtrado($_POST['email']);
        $subject = SUBJECT_INSCRIPCION;
        $message = AGRADECIMIENTO_INSCRIPCION;
        $messageTextoPlano = SUBJECT_INSCRIPCION;
        mandarMail($correoDestino,$subject, $message, $messageTextoPlano);
    }else{
        echo "false";
    }
}
