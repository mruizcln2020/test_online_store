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

		<!--Contenido-->
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">        
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="box">
							<div class="box-header with-border">
								<div class="box-header with-border">
									<h1 id="titulo"></h1>
								</div>
								
								<!-- GUARDAR NUEVO -->
								<div class="panel-body" style="height: auto;" id="divNuevo">
									<form name="formulario" id="formulario" method="POST">
										<div class="panel panel-info col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="panel-heading">Información General</div>
											<div>
												<label>&nbsp;</label>
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label> IVA: *</label>
												<input type="text" class="form-control" name="iva" id="iva" maxlength="2" placeholder="iva" required>
											</div>
										</div>
										<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
										</div>
									</form>
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

<script type="text/javascript" src="scripts/configuracionJS.js"></script>

<?php
} 
ob_end_flush();
?>