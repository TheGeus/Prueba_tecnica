<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Técnica</title>
    <link rel="stylesheet" href="util/css/styles.css?version=<?php echo mt_rand(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="util/js/config.js?version=<?php echo mt_rand(); ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="m-0 vh-100 row justify-content-center align-items-center position-relative" id="contenedor">
        <button type="button" class="btn btn-rose col-auto" data-bs-toggle="modal" data-bs-target="#webinarModal" data-bs-whatever="@getbootstrap">Inscribirse Webinar</button>
        <div class="modal fade" id="webinarModal" tabindex="-1" aria-labelledby="webinarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="webinarModalLabel">Inscripción del Evento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="prueba" action="#" method="POST">
                        <div class="modal-body">
                           <div class="mb-3">
                               <input type="hidden" name="INSCRIPCION_GRACIAS" value="<?php echo mt_rand(); ?>">
                               <label for="email" class="col-form-label">Su email:</label>
                               <input class="form-control" type="email" name="email" id="email" placeholder="example@example.com" value="<?php echo !empty($_POST['email']) ?  $_POST['email'] : "" ?>" required>
                           </div>
                           <div class="mb-3">
                               <label for="telefono" class="col-form-label">Su Teléfono:</label>
                               <div class="input-group">
                                   <div class="input-group-prepend">
                                       <div class="input-group-text">+34</div>
                                   </div>
                                   <input class="form-control" type="tel" name="telefono" id="telefono" placeholder="(666)666666 o (766)666666" value="<?php echo !empty($_POST['telefono']) ?  $_POST['telefono'] : "" ?>" required>
                               </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-rose" id="guardar" name="enviar">Inscribirse</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="countdown">
            <div id="dia"></div>
            <div id="hora"></div>
            <div id="min"></div>
            <div id="seg"></div>
        </div>
    </div>
    <footer class="bg-dark text-center text-white">
        <div class="container p-2">
            <!-- social media -->
            <section class="mb-2">
            <!-- Instagram -->
            <a class="btn btn-outline-light btn-floating m-1" target="_blank" href="https://www.instagram.com/analyticalways/" role="button"
                ><img src="https://img.icons8.com/ios/50/000000/instagram-new.png"></a>
            <!-- Youtube -->
            <a class="btn btn-outline-light btn-floating m-1" target="_blank" href="https://www.youtube.com/c/Analyticalways" role="button"
                ><img src="https://img.icons8.com/ios/50/000000/youtube-play--v1.png">
            </a>
            <!-- Linkedin -->
            <a class="btn btn-outline-light btn-floating m-1" target="_blank" href="https://www.linkedin.com/company/analyticalways/" role="button"
                ><img src="https://img.icons8.com/ios/50/000000/linkedin.png">
            </a>
            </section>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2021 Copyright:
            <a class="text-white" href="https://analyticalways.com/">analyticalways.com</a>
        </div>
    </footer>
    <script type="application/javascript">
        $(function(){
            $("#prueba").on('submit', function(e){
                //#evitamos que manden el formulario sin validar
                e.preventDefault();
                //#desactivamos el boton para evitar duplicidad
                $(this).find(':submit').attr('disabled','disabled');

                //#mensajes para el usuario 
                const VALIDO = "Se ha enviado la invitación al correo.";
                const CORREO_INVALIDO = "Su correo es inválido. Por favor, compruebe el mismo.";
                const NUMERO_TELEFONO_INVALIDO = "Su numero de teléfono es inválido. Por favor, compruebe el mismo.";
                const FALLO_EMAIL = "UPS! No se ha podido subscribir. Intente nuevamente.";
                
                //#formulario
                const formulario = new FormData(this);

                //#variables
                let emailvalid = false, 
                    telefonovalid = false,
                    email = $('#email'),
                    telefono;
                emailvalid = validarEmail(formulario.get("email"));
                telefonovalid = validarTelefono(formulario.get("telefono"));
                $('#webinarModal').modal('toggle');
                if(emailvalid == true){
                    if(telefonovalid == true){
                        $.ajax({
                        url: 'backend/doinback.php',
                        method: 'POST',
                        data: formulario,
                        processData: false,
                        contentType: false,
                        success:function(response){
                            if(response == "true"){
                                $('#contenedor').append(notificar(VALIDO));
                            }
                            if(response == "false"){
                                $('#contenedor').append(notificar(FALLO_EMAIL));
                            }
                        },
                        error:function(error){
                            $('#contenedor').append(notificar(FALLO_EMAIL));
                        }
                    });
                    }else{
                        $('#contenedor').append(notificar(NUMERO_TELEFONO_INVALIDO));
                    }
                }else{
                    $('#contenedor').append(notificar(FALLO_EMAIL));
                }
                
                setInterval(() => {
                    $(this).find(':submit').attr('disabled', false);
                    }, 1000);
            });
        });
        function notificar(mensaje){
            return "<div class=\"toast bg-primary text-white fade show position-absolute top-0 end-0 \">"
                    +"<div class=\"toast-header bg-primary text-white\">"
                    +"    <strong class=\"me-auto\"><i class=\"bi-gift-fill\"></i>Webinar, mensaje!</strong>"
                    +"    <small>ahora</small>"
                    +"    <button type=\"button\" class=\"btn-close btn-close-white\" data-bs-dismiss=\"toast\"></button>"
                    +"</div>"
                    +"<div class=\"toast-body\">"
                    +mensaje
                    +"</div>"
                    +"</div>"
        }
        function tiempoRestante(tiempo){
            let contador = $('#countdown');
            let getDia = $('#dia');
            let getHora = $('#hora');
            let getMin = $('#min');
            let getSeg = $('#seg');

            const reloj = () => {
                let tiempoRes = Date.parse(tiempo) - Date.parse(new Date());
                let dia = Math.floor(tiempoRes / (1000 * 60 * 60 * 24));
                let hora = Math.floor(tiempoRes / (1000 * 60 * 60));
                let min = Math.floor(tiempoRes / (1000 * 60));
                let seg = Math.floor(tiempoRes / (1000) % 60);

                return {'tiempoRestante':tiempoRes, 'dia':dia, 'hora':hora, 'min':min, 'seg':seg} 
            }
            const actualizarReloj = (reloj) => {

                
                const pluralSingular = (numero) => {
                
                }
                if(tiempoRes <= 0){
                    clearInterval();
                    contador.html("<div></div>");
                }
            }
        }
    </script>
</body>
</html>