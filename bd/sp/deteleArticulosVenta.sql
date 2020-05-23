DROP PROCEDURE IF EXISTS deteleArticulosVenta;
 
DELIMITER $$
 
CREATE PROCEDURE deteleArticulosVenta()

BEGIN

	/* SE ELIMINA EL ARTICULO */
	DELETE FROM temporal;

END $$
DELIMITER ;
