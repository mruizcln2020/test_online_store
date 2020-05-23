<?php 

session_start();
require_once "../modelos/GenericModel.php";

//Instancia el objeto a procesar con la BD y obtiene la info de la vista mediante POST
$genericModel = new GenericModel();

switch ($_GET['op']) {

	case 'checkLogin':
		$usuarioId = 0;
        $logina = $_POST['logina'];
        $clavea = $_POST['clavea'];
        $rspta = $genericModel->checkLogin($logina, $clavea);
        $fetch = $rspta->fetch_object();
        if (isset($fetch))
        {
        	$_SESSION['usuario'] = $fetch->usuario;
        	$_SESSION['password'] = $fetch->password;
            $_SESSION['admin'] = 1;
            $_SESSION['normal'] = 1;

            echo $usuarioId = 1;
        } 
    break;

    default:
    break;
    }

?>