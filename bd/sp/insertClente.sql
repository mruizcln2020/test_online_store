DROP PROCEDURE IF EXISTS insertCliente;
 
DELIMITER $$
 
CREATE PROCEDURE insertCliente(IN _nombre CHAR(64), IN _apellidoPaterno CHAR(64), IN _apellidoMaterno CHAR(64), IN _rfc CHAR(64))

BEGIN

	DECLARE _idCliente INT DEFAULT 0;
	

	/* SE INSERTA EL PRESTAMO */
	INSERT INTO clientes(nombre, apellido_paterno, apellido_materno, rfc) 
					VALUES (_nombre, _apellidoPaterno, _apellidoMaterno, _rfc);
	
	/* SE OBTIENE Y RETORNA EL ULTIMO ID INSERTADO */
	SELECT LAST_INSERT_ID() INTO _idCliente;

	
	SELECT _idCliente;

END $$
DELIMITER ;
