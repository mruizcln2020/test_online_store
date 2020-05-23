DROP PROCEDURE IF EXISTS deteleArticulo;
 
DELIMITER $$
 
CREATE PROCEDURE deteleArticulo(IN _articuloId INT)

BEGIN

	/* SE ELIMINA EL ARTICULO */
	DELETE FROM articulos WHERE articulo_id = _articuloId;

END $$
DELIMITER ;
