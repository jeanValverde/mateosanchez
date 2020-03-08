<?php
session_start();

if(isset($_POST['ContactoEnviar'])   && !empty($_POST['name']) && !empty($_POST['email']) && (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) && !empty($_POST['phone'])&& !empty($_POST['message'])){

    // Datos enviados desde el formulario modal

    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $phone= $_POST['phone'];
    $message= $_POST['message'];
    /* Enviar email al administrador */
    $to     = 'info@mateosanchez.cl';
    $subject= 'Solicitud de VENTA Y ARRIENDO MI PROPIEDAD enviada';


    $htmlContent= '

    <h4>SOLICITUD DE VENTA Y ARRIENDO.</h4>
    <table cellspacing="0" style="width: 300px; height: 200px;">


        <tr>
            <th>Nombre:
                  link:</th><td>'.$name .'</td>
        </tr>
        <tr style="background-color: #e0e0e0;">
            <th>Email:</th><td>'.$email.'</td>
        </tr>
        <tr>
            <th>Phone:</th><td>'.$phone.'</td>
        </tr>
        <tr>
            <th>Mensaje:</th><td>'.$message.'</td>
        </tr>
    </table>';



    // Establecer encabezado de tipo de contenido para enviar Email HTML
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Encabezados adicionales
    $headers .= 'De: Mateos Sanchez<info@mateosanchez.cl>' . "\r\n";

    // Enviar el Email
    if(mail($to,$subject,$htmlContent,$headers)){
        $status = 'bien';
    }else{
        $status = 'Error';
    }

    // Estado de la salida del correo
    echo $status;die;



}
