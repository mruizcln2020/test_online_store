DROP PROCEDURE IF EXISTS insertArticuloTemp;
 
DELIMITER $$
 
CREATE PROCEDURE insertArticuloTemp(IN _cantidad INT, IN _pu DECIMAL(10,2), IN _pt DECIMAL(10,2), IN _articuloId INT)

BEGIN

	DECLARE _idArticuloTemp INT DEFAULT 0;
	

	/* SE INSERTA EL PRESTAMO */
	INSERT INTO temporal(cantidad, pu, pt, articulo_id) 
				VALUES (_cantidad, _pu, _pt, _articuloId);
	
	/* SE OBTIENE Y RETORNA EL ULTIMO ID INSERTADO */
	SELECT LAST_INSERT_ID() INTO _idArticuloTemp;

	
	SELECT _idArticuloTemp;

END $$
DELIMITER ;
