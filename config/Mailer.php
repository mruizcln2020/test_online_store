<?php 
  
  session_start();

  switch ($_GET['op']) {

    case 'sendMailAlta':

      $empresa = $_SESSION['empresa'];
      $empleado = $_GET['empleado'];
      $nss = $_GET['nss'];
      $sdi = $_GET['sdi'];
      $fecha = date('Y-m-d H:i:s');

      $para  = ''; // atención a la coma
      $título = 'Alta Empleado - ' . $empresa;

      $mensaje = '<html>
                    <head>
                      <title>Solicitud de Alta</title>
                    </head>
                    <body>
                      <p>Esta es una solicitud automatica de alta de empleado en el IMSS</p>
                      <table>
                        <tr>
                          <td><b>Nombre</b></td><td> ' . $empleado . '</td>
                        </tr>
                        <tr>
                          <td>Empresa</td><td> ' . $empresa . '</td>
                        </tr>
                        <tr>
                          <td>NSS</td><td> ' . $nss . '</td>
                        </tr>
                        <tr>
                          <td>SDI</td><td> ' . $sdi . '</td>
                        </tr>
                        <tr>
                          <td>Fecha</td><td> ' . $fecha . '</td>
                        </tr>
                      </table>
                      <br>
                      <p>No es necesario responder a este correo, ya que se envio desde un motor automatizado.</p>
                    </body>
                  </html>';

      // Para enviar un correo HTML, debe establecerse la cabecera Content-type
      $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
      $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

      // Cabeceras adicionales
      $cabeceras .= 'To: Jacqueline Rios <jacquelinerios@asistem.mx>' . "\r\n";
      $cabeceras .= 'Cc: Misael Ruiz <misaelruiz@asistem.mx>, Ernesto Prieto <ernestoprieto@asistem.mx>' . "\r\n";

      //mail($para, $título, $mensaje, $cabeceras);
      //exit;

      echo $mensaje;

    break;

  }

  

  
?>