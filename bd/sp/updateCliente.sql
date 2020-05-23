DROP PROCEDURE IF EXISTS updateCliente;
 
DELIMITER $$
 
CREATE PROCEDURE updateCliente(IN _clienteId INT, IN _nombre CHAR(64), IN _apellidoPaterno CHAR(64), IN _apellidoMaterno CHAR(64), IN _rfc CHAR(64))

BEGIN
	
	UPDATE clientes
	SET nombre = _nombre, 
		apellido_paterno = _apellidoPaterno,
		apellido_materno = _apellidoMaterno,
		rfc = _rfc
	WHERE cliente_id = _clienteId;
									
END $$
DELIMITER ;

