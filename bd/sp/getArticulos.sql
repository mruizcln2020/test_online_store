DROP PROCEDURE IF EXISTS getArticulos;
 
DELIMITER $$
 
CREATE PROCEDURE getArticulos()

BEGIN

	SELECT 	a.articulo_id as articuloId, 
			a.marca,
			a.modelo,
			a.descripcion,
			a.precio,
			a.existencia
	FROM articulos a;

END $$
DELIMITER ;
