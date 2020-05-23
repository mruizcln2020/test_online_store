DROP PROCEDURE IF EXISTS getArticulosById;
 
DELIMITER $$
 
CREATE PROCEDURE getArticulosById(IN _idArticulo INT)

BEGIN

	SELECT 	a.articulo_id as articuloId,
			a.marca, 
			a.modelo, 
			a.descripcion, 
			a.precio, 
			a.existencia 
	FROM articulos a
	WHERE a.articulo_id = _idArticulo;

END $$
DELIMITER ;
