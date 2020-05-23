DROP PROCEDURE IF EXISTS getClientesById;
 
DELIMITER $$
 
CREATE PROCEDURE getClientesById(IN _idCliente INT)

BEGIN

	SELECT 	a.cliente_id as clienteId, 
			a.nombre as nombre,
			a.apellido_paterno as apellidoPaterno,
			a.apellido_materno as apellidoMaterno,
			a.rfc
	FROM clientes a
	WHERE a.cliente_id = _idCliente;

END $$
DELIMITER ;
