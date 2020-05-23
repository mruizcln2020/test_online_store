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

								<!-- GRID -->
								<div class="panel-body table-responsive" id="divListado">
									<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
										<thead>
											<th>Acciones</th>
											<th>Codigo</th>
											<th>Nombre</th>
											<th>Apellido Paterno</th>
											<th>Apellido Materno</th>
											<th>RFC</th>
										</thead>
										<tbody>                            
										</tbody>
									</table>
									<button class="btn btn-primary" type="submit" id="btnAgregar" onclick="mostrarDivNuevo(true)"><i class="fa fa-plus-square"></i> . Registrar Cliente</button>
								</div>

								<!-- GUARDAR NUEVO -->
								<div class="panel-body" style="height: auto;" id="divNuevo">
									<form name="formulario" id="formulario" method="POST">
										<div class="panel panel-info col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="panel-heading">Información General</div>
											<div>
												<label>&nbsp;</label>
												<input type="hidden" name="estaActualizando" id="estaActualizando"> </input>
											</div>
											<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<label> Nombre: *</label>
												<input type="text" class="form-control" name="nombre" id="nombre" maxlength="256" placeholder="Nombre Completo" required>
											</div>
											<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<label> Apellido Paterno: *</label>
												<input type="text" class="form-control" name="apellidoPaterno" id="apellidoPaterno" maxlength="256" placeholder="Nombre Completo" required>
											</div>
											<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<label> Apellido Materno: </label>
												<input type="text" class="form-control" name="apellidoMaterno" id="apellidoMaterno" maxlength="256" placeholder="Nombre Completo">
											</div>
											<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<label> RFC: </label>
												<input type="text" class="form-control" name="rfc" id="rfc" maxlength="256" placeholder="Nombre Completo">
											</div>
										</div>

										<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
											<button class="btn btn-danger" id="btnCancelar" onclick="mostrarDivListado(true)" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
										</div>
									</form>
								</div>

								<!-- EDITAR EXISTENTE -->
								<div class="panel-body" style="height: auto;" id="divEditar">
									<form name="formularioEditar" id="formularioEditar" method="POST">
										<div class="panel panel-info col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="panel-heading">Información General:</div>
											<div>
												<label>&nbsp;</label>
											</div>
											<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<label> Nombre *</label>
												<input type="text" class="form-control" name="nombreEditar" id="nombreEditar" maxlength="256" placeholder="Nombre Completo" required>
											</div>
											<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<label> Apellido Paterno *</label>
												<input type="text" class="form-control" name="apellidoPaternoEditar" id="apellidoPaternoEditar" maxlength="256" placeholder="Nombre Completo" required>
											</div>
											<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
												<label> Apellido Materno</label>
												<input type="text" class="form-control" name="apellidoMaternoEditar" id="apellidoMaternoEditar" maxlength="256" placeholder="Nombre Completo">
											</div>
										</div>
										<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<button class="btn btn-primary" type="submit" id="btnGuardarEditar"><i class="fa fa-save"></i> Guardar</button>
											<button class="btn btn-danger" id="btnCancelarEditar" onclick="mostrarDivListado(true)" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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

<script type="text/javascript" src="scripts/clientesJS.js"></script>

<?php
} 
ob_end_flush();
?>