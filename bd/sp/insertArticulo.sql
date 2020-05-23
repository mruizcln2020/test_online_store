DROP PROCEDURE IF EXISTS insertArticulo;
 
DELIMITER $$
 
CREATE PROCEDURE insertArticulo(IN _marca CHAR(64), IN _modelo CHAR(64), IN _descripcion CHAR(64), IN _precio FLOAT, IN _existencia INT)

BEGIN

	DECLARE _idArticulo INT DEFAULT 0;
	

	/* SE INSERTA EL PRESTAMO */
	INSERT INTO articulos(marca, modelo, descripcion, precio, existencia) 
				VALUES (_marca, _modelo, _descripcion, _precio, _existencia);
	
	/* SE OBTIENE Y RETORNA EL ULTIMO ID INSERTADO */
	SELECT LAST_INSERT_ID() INTO _idArticulo;

	
	SELECT _idArticulo;

END $$
DELIMITER ;
