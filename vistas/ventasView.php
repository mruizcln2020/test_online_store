<?php

//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["usuario"]))
{
	header("Location: login.html");
}
else
{
	require 'header.php';
	//print_r($_SESSION);
	if($_SESSION['admin'] == 1 || $_SESSION['normal'] == 1)
	{
?>

		<div class="content-wrapper">        
			<section class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="box">
							<div class="box-header with-border">
								<div class="box-header with-border">
									<h1 id="titulo"></h1>
								</div>
								<!-- GRID -->
								<div class="panel-body table-responsive" id="divListado">
									<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
										<thead>
											<th>Folio</th>
											<th>Fecha</th>
											<th>ID Cliente</th>
											<th>Cliente</th>
											<th>Importe</th>
											<th>IVA</th>
											<th>Desc</th>
											<th>Total</th>
										</thead>
										<tbody>                            
										</tbody>
									</table>
									<!--<button class="btn btn-primary" type="submit" id="btnAgregar" onclick="mostrarDivNuevo(true)"><i class="fa fa-plus-square"></i> . Nueva Venta</button> -->
									<button class="btn btn-primary" onclick="redirigirRegistrarVenta()"> <i class="fa fa-plus-square"></i> Nueva Venta</button>
								</div>
							</div><!-- /.box -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->

			</div><!-- /.content-wrapper -->
			<!--Fin-Contenido-->

<?php
	}
	else
	{
		require 'noAccesoView.php';
	}
	require 'footer.php';
?>

<script type="text/javascript" src="scripts/ventasJS.js"></script>

<?php
} 
ob_end_flush();
?>