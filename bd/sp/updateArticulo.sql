DROP PROCEDURE IF EXISTS updateArticulo;
 
DELIMITER $$
 
CREATE PROCEDURE updateArticulo(IN _articuloId INT, IN _marca CHAR(64), IN _modelo CHAR(64), IN _descripcion CHAR(64), IN _precio DECIMAL(10,2), IN _existencia INT)

BEGIN
	
	UPDATE articulos
	SET marca = _marca, 
		modelo = _modelo,
		descripcion = _descripcion,
		precio = _precio,
		existencia = _existencia
	WHERE articulo_id = _articuloId;
									
END $$
DELIMITER ;
