<?php
 class ArticuloVentaEntity{
	 private articuloId;
	 private descripcion;
	 private marca;
	 private cantidad;
	 private pu;
	 private pt;
 
	 public function __construct($artId,$desc){
		 $this->articuloId = $artId;
		 $this->descripcion = $desc;
	 }
 
	public function __set($var, $valor){
		// convierte a minúsculas toda una cadena la función strtolower
		$temporal = strtolower($var);
		// Verifica que la propiedad exista, en este caso el nombre es la cadena en "$temporal"
		if (property_exists('ArticuloVentaEntity',$temporal)){
			$this->$temporal = $valor;
		}
		else
		{
			echo $var . " No existe.";
		}
	}

	public function __get($var){
		$temporal = strtolower($var);
		// Verifica que exista
		if (property_exists('empleado', $temporal)){
			return $this->$temporal;
		}
		// Retorna nulo si no existe
		return NULL;
	}
}

?>